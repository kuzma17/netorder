<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmPolicy
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

    public function add(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function edit(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function del(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }
}
