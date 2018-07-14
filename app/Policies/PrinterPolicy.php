<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrinterPolicy
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

    public function create(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function store(User $user){
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

    public function update(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function delete(User $user){
        if($user->is_admin()){
            return true;
        }
        return false;
    }
}
