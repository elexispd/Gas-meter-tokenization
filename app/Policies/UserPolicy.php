<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        return $user->is_super_admin;
    }
    public function show(User $user) {
        return $user->is_super_admin;
    }
    public function edit(User $user) {
        return auth()->user()->is_super_admin;
    }
    public function delete(User $user) {
        return $user->is_super_admin;
    }

    public function notEndUser(User $user) {
        return !$user->meter_number;
    }

    public function admins(User $user) {
        return $user->is_super_admin || $user->is_admin;
    }

    public function token(User $user) {
        return $user->meter_number != null;
    }
    public function users(User $user) {
        return $user->meter_number != null || $user->is_tenant;
    }

    public function is_tenant() {
        return auth()->user()->is_tenant;
    }


}
