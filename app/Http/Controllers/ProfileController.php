<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Plant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\ActivityLogger;
use Illuminate\Validation\Rules;
use App\Jobs\SendRegisterEmail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function __construct(
        public ActivityLogger $activityLogger
    ) {}

    private function validate_phone($phone): string {
        $phone = preg_replace('/\D/', '', $phone);
        $phone = preg_replace('/^(\+?0*)/', '', $phone);
        $phone = preg_replace('/^(\d{3})0?/', '$1', $phone);
        return $phone;
    }

    public function create() {
        $plants = Plant::whereNull('deleted_at')->get();
        return view('profile.clients.create', compact('plants'));
    }
    public function index() {
        $users = User::whereNotNull('meter_number')->whereNull('deleted_at')->with('plants')->get();

        return view('profile.clients.index', compact('users'));
    }

    public function store(Request $request) {
        try {
            $validated_data = $this->validate($request, [
                'first_name' =>'required',
                'last_name' =>'required',
                'email' =>'required|email|unique:users,email',
                'phone_number' =>'required|string|unique:users,phone_number',
                'meter_number' =>'required|unique:users,meter_number',
                'state' =>'required',
                'country' =>'required',
                'plant' =>'required',
            ]);
        } catch (ValidationException $e) {
            // Customizing the error message for the unique email rule
            $errors = $e->validator->errors()->getMessages();
            $errors['email'] = ['The email address is already in use.'];

            return redirect()->back()->withErrors($errors)->withInput();
        }
        // Start a database transaction
        DB::beginTransaction();

        try {
            $phone = $this->validate_phone($validated_data["phone_number"]);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $phone,
                'meter_number' => $request->meter_number,
                'address' => $request->address,
                'state' => $request->state,
                'country' => $request->country,
                'password' => Hash::make($request->meter_number)
            ]);

            $name = $request->first_name;
            // SendRegisterEmail::dispatch($name, $request->email, $password)->onQueue('emails');

            Mail::to($request->email)->send(new RegisterMail($request->first_name, $request->meter_number, $request->meter_number));

            if (!$user) {
                throw new \Exception('Failed to create user.');
            }

            $plant = Plant::findOrFail($request->plant); // Assuming you have a Plant model

            // Attach user to plant
            $user->plants()->attach($plant->id, ['created_at' => now()]);

            // Commit the transaction if all steps succeed
            DB::commit();
            $this->activityLogger->logActivity(auth()->id(), 'User Created', 'User With Meter-Number ' .  $request->input('meter_number') . " is created" );
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'User was created successfully.']);
        } catch (\Exception $e) {
            // If any operation fails, rollback the transaction
            DB::rollback();
            $this->activityLogger->logActivity(auth()->id(), 'User Failed', 'User With Meter-Number ' .  $request->input('meter_number') . " failed to create" );
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }



    public function edit(User $user)
    {
        $user->load('plants');
        $plants = Plant::all();
        return view('profile.clients.edit', compact('user', 'plants'));
    }

    public function show(User $user)
    {
        $plant_count = $user->tenantPlants()->count();
        $endUsersCount = $user->usersUsingMyPlants()->count();
        return view('profile.show', compact('user', 'plant_count', 'endUsersCount'));
    }



    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'meter_number' => 'required|string|max:255',
            'plant' => 'required|exists:plants,id'
        ]);

        $phone = $this->validate_phone($validatedData["phone_number"]);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $phone,
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'meter_number' => $validatedData['meter_number']
        ]);


        // Sync the user's associated plant
        $user->plants()->sync($validatedData['plant']);
        $this->activityLogger->logActivity(auth()->id(), 'User Updated', 'User With Meter-Number ' .  $request->input('meter_number') . " is updated" );
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'user updated successfully.']);
     }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();
        $this->activityLogger->logActivity(auth()->id(), 'User Deleted', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " is created" );
        return response()->json(['message' => 'User deleted successfully']);
    }


    public function tenant_create() {
        $plants = Plant::whereNull('deleted_at')->get();
        return view('profile.tenants.create', compact('plants'));
    }
    public function tenant_index() {
        $users = User::where('is_tenant', true)->whereNull('deleted_at')->get();

        return view('profile.tenants.index', compact('users'));
    }

    public function tenant_store(Request $request) {
        try {
            $validated_data = $this->validate($request, [
                'first_name' =>'required',
                'last_name' =>'required',
                'email' =>'required|email|unique:users,email',
                'phone_number' =>'required|string|unique:users,phone_number',
                'state' =>'required',
                'country' =>'required',
            ]);
        } catch (ValidationException $e) {
            // Customizing the error messagefor the unique email rule
            $errors = $e->validator->errors()->getMessages();
            $errors['email'] = ['The email address is already in use.'];

            return redirect()->back()->withErrors($errors)->withInput();
        }



        try {
            $password = 'tenant12345';
            $phone = $this->validate_phone($validated_data["phone_number"]);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $phone,
                'address' => $request->address,
                'state' => $request->state,
                'is_tenant' => true,
                'country' => $request->country,
                'password' => Hash::make($password)
            ]);

            $name = $request->first_name;
            // SendRegisterEmail::dispatch($name, $request->email, $password)->onQueue('emails');

            Mail::to($request->email)->send(new RegisterMail($request->first_name, $request->email, $password));


            if (!$user) {
                throw new \Exception('Failed to create user.');
            }

            $this->activityLogger->logActivity(auth()->id(), 'Tenant Created', 'Tenant With email ' .  $request->input('email') . " is created" );
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Tenant was created successfully.']);
        } catch (\Exception $e) {
            // If any operation fails, rollback the transaction
            DB::rollback();
            $this->activityLogger->logActivity(auth()->id(), 'Tenant Failed', 'Tenant With email ' .  $request->input('email') . " failed to create" );
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }



    public function tenant_edit(User $user)
    {
        return view('profile.tenants.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function tenant_update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',

        ]);

        $is_super_admin = $request->has('is_super_admin');

        $phone = $validatedData["phone_number"];
            // Remove non-digit characters and the leading '+'
            $phone = preg_replace('/\D|^(\+?)/', '', $phone);

            // Remove '0' after the first 3 digits
            $phone = preg_replace('/^(\d{3})0/', '$1', $phone);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $phone,
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'is_super_admin' => $is_super_admin,
        ]);

        $this->activityLogger->logActivity(auth()->id(), 'User Updated', 'Tenant with name ' .  $request->input('first_name'). " ". $request->input('last_name') . " is updated" );
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'user updated successfully.']);
    }

    /**
     * Delete the user's account.
     */
    public function tenant_destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();
        $this->activityLogger->logActivity(auth()->id(), 'User Deleted', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " is created" );
        return response()->json(['message' => 'User deleted successfully']);
    }



    public function admin_create() {
        $plants = Plant::whereNull('deleted_at')->get();
        return view('profile.admins.create');
    }
    public function admin_index() {
        $users = User::where('is_admin', true)->whereNull('deleted_at')->get();
        return view('profile.admins.index', compact('users'));
    }

    public function admin_store(Request $request) {
        try {
            $validated_data = $this->validate($request, [
                'first_name' =>'required',
                'last_name' =>'required',
                'email' =>'required|email|unique:users,email',
                'phone_number' =>'required|string|unique:users,phone_number',
                'state' =>'required',
                'country' =>'required',
            ]);
        } catch (ValidationException $e) {
            // Customizing the error message for the unique email rule
            $errors = $e->validator->errors()->getMessages();
            $errors['email'] = ['The email address is already in use.'];

            return redirect()->back()->withErrors($errors)->withInput();
        }

        try {
            $password = 'admin12345';
            $phone = $this->validate_phone($validated_data["phone_number"]);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $phone,
                'address' => $request->address,
                'state' => $request->state,
                'is_admin' => true,
                'country' => $request->country,
                'password' => Hash::make($password)
            ]);


            if (!$user) {
                throw new \Exception('Failed to create admin.');
            }

            $this->activityLogger->logActivity(auth()->id(), 'Admin 2 Created', 'Admin With email ' .  $request->input('email') . " is created" );
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Administrator 2 was created successfully.']);
        } catch (\Exception $e) {
            // If any operation fails, rollback the transaction
            DB::rollback();
            $this->activityLogger->logActivity(auth()->id(), 'Admin Failed', 'Admin With email ' .  $request->input('email') . " failed to create" );
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }



    public function admin_edit(User $user)
    {
        return view('profile.tenants.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function admin_update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',

        ]);
        $phone = $this->validate_phone($validatedData["phone_number"]);
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
        ]);

        $this->activityLogger->logActivity(auth()->id(), 'User Updated', 'Tenant with name ' .  $request->input('first_name'). " ". $request->input('last_name') . " is updated" );
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'user updated successfully.']);
    }

    /**
     * Delete the user's account.
     */
    public function admin_destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->delete();
        $this->activityLogger->logActivity(auth()->id(), 'User Deleted', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " is created" );
        return response()->json(['message' => 'User deleted successfully']);
    }


    public function change_password() {
        return view('profile.change-password');
    }
    public function change_password_store(Request $request) {

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
        $this->activityLogger->logActivity(auth()->id(), 'User Password Change', 'User  ' .  $user->first_name . " ". $user->last_name . " changed password" );
        return redirect()->back()->with('alert',['type' => 'success','message' => 'password changed successfully']);
    }







}
