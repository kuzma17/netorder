<?php

namespace App\Policies;

use App\Order;
use App\User;
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

    public function add(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function edit(User $user, $user_param){
        if($user->is_admin()){
            return true;
        }

        if($user_param->id == $user->id){
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

    public function menu(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function filter_firm(User $user){
        if($user->is_admin() || $user->is_contractor()){
            return true;
        }
        return false;
    }

    public function filter_branch(User $user){
        if($user->is_admin() || $user->is_admin_firm() || $user->is_contractor()){
            return true;
        }
        return false;
    }

    public function filter_contractor(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }
}
