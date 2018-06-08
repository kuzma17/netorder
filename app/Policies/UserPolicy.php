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
       // foreach ($user->roles as $role){
        //    if($role->label == 'admin'){
        //        return true;
       //     }
       // }
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function edit(User $user, $user_param){
        //foreach ($user->roles as $role){
        //    if($role->label == 'admin'){
         //       return true;
        //    }
        if($user->is_admin()){
            return true;
        }

        if($user_param->id == $user->id){
            return true;
        }
        return false;
    }

    public function del(User $user){
        //foreach ($user->roles as $role){
        //    if($role->label == 'admin'){
       //         return true;
        //    }
       // }
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function menu(User $user){
        //foreach ($user->roles as $role){
        //    if($role->label == 'admin'){
          //      return true;
        //    }
      //  }
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function filter(User $user){
       // foreach ($user->roles as $role){
       //     if($role->label == 'admin'){
         //       return true;
        //    }
       // }
        if($user->is_admin()){
            return true;
        }
        return false;
    }

    public function filter_branch(User $user){
       // foreach ($user->roles as $role){
      //      if($role->label == 'admin' || $role->label == 'admin_firm'){
       //         return true;
       //     }
     //   }
        if($user->is_admin() || $user->is_admin_firm()){
            return true;
        }
        return false;
    }
}
