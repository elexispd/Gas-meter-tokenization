<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Mail;
use App\Mail\TokenMail;
class PlantController extends Controller
{

    public function __construct(
        public ActivityLogger $activityLogger
    ) {}
    public function create() {
        $tenants = User::where('is_tenant', 1)->whereNull('deleted_at')->get();
        return view('plants.create', compact('tenants'));
    }

    public function index() {
        $plants= Plant::whereNull('deleted_at')->get();
        return view('plants.index', compact('plants'));
    }

    public function edit(Plant $plant) {
        $tenants = User::where('is_tenant', 1)->whereNull('deleted_at')->get();
        return view('plants.edit', compact('plant', 'tenants'));
    }


    public function update(Request $request, Plant $plant) {
        $validatedData = $request->validate([
            'country' => ['required', 'max:80', 'min:2'],
            'state' => ['required', 'max:80', 'min:2'],
            'address' => ['required', 'max:100', 'min:5'],
            'tenant_id' => ['required', 'max:100', 'min:1'],
        ]);


        if($plant->update($validatedData) ) {
            $this->activityLogger->logActivity(auth()->id(), 'Plant Created', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " is updated" );
             return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Plant updated successfully.']);
        } else {
        $this->activityLogger->logActivity(auth()->id(), 'Plant Updated', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " failed to update" );
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Something went wrong"] );
        }
    }


    public function store(Request $request) {
        $request->validate([
            'country' => ['required', 'max:80', 'min:2'],
            'state' => ['required', 'max:80', 'min:2'],
            'address' => ['required', 'max:100', 'min:5'],
            'tenant' => ['required', 'max:100', 'min:1'],
        ]);

        $is_saved = Plant::create([
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'address' => $request->input('address'),
            'tenant_id' => $request->input('tenant')
        ]);

        if ($is_saved) {
             // Log activity
            $this->activityLogger->logActivity(auth()->id(), 'Plant Created', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " is created" );
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Plant created successfully.']);
        } else {
            $this->activityLogger->logActivity(auth()->id(), 'Plant Creation Failed', 'Plant with Address  ' .  $request->input('address') . " " .  $request->input('state') . " ".  $request->input('country'). " failed to create" );
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to create plant.']);
        }

    }

    public function destroy(Request $request)
    {
        $plant = Plant::findOrFail($request->plant_id);
        $plant->delete();
        // Log activity
        $this->activityLogger->logActivity(auth()->id(), 'Plant Deleted', 'Plant with Address  ' . $plant->address . " " . $plant->state . " ". $plant->country. " is deleted" );
        return response()->json(['message' => 'Plant deleted successfully']);
    }

    public function my_plants(User $user) {
        $user->with('plantss')->get();
        return view('profile/tenants.plants.index', compact('user'));
    }
    public function my_consumers(User $user)
    {

        $consumers = $user->usersUsingMyPlants();

        // Pass the data to the view
        return view('profile/tenants.consumers.index', compact('user', 'consumers'));
    }

    public function plantConsumers($id)
    {
        $plant = Plant::findOrFail($id);
        $consumers = $plant->users()->get();
        return view('plants.plant-users', compact('plant', 'consumers'));
    }

}
