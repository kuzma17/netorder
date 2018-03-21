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
        foreach ($user->roles as $role){
            if($role->label == 'admin'){
                return true;
            }
        }
        return false;
    }

    public function edit(User $user){
        foreach ($user->roles as $role){
            if($role->label == 'admin'){
                return true;
            }
        }
        return false;
    }

    public function del(User $user){
        foreach ($user->roles as $role){
            if($role->label == 'admin'){
                return true;
            }
        }
        return false;
    }
}
