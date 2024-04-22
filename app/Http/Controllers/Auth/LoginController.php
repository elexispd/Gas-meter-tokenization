<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Determine the user's username field based on input.
     *
     * @return string
     */
    public function username()
    {
        $field = request()->input('identifier');
        return filter_var($field, FILTER_VALIDATE_EMAIL) ? 'email' : 'meter_number';
    }

    /**
     * Attempt to authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
{
    // Determine the username field dynamically based on input
    $field = $this->username();
    $credentials = $request->only('identifier', 'password');


    // Retrieve user based on email or meter_number
    $user = User::where($field, $credentials['identifier'])->first();
    if(!$user) {
        return back()->withErrors([
        'identifier' => 'Email does not exist.',
        ]);
    }

    // Check if the user exists and the password is correct
    if ($user && Hash::check($request->input('password'), $user->password)) {
        // Authentication passed, log the user in
        Auth::login($user);
        return redirect()->intended('/dashboard');
    }

    // Authentication failed, redirect back with error message
    return back()->withErrors([
        'identifier' => 'The provided credentials do not match our records.',
    ]);
}




}
