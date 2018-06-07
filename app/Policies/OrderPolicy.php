<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
            if($role->label == 'client'){
                return true;
            }
        }
        return false;
    }

    public function edit(User $user, Order $order){
        foreach ($user->roles as $role){
            if($role->label == 'admin'){
                return true;
            }
            if($role->label == 'client'){
                if($order->status->label == 'wait'){
                    return true;
                }
            }
            if($role->label == 'contractor'){
                return true;
            }
        }
        return false;
    }

    public function del(User $user, Order $order){
        foreach ($user->roles as $role){
            if($role->label == 'admin'){
                return true;
            }
            if($role->label == 'client'){
                if($order->status->label == 'wait'){
                    return true;
                }
            }
        }
        return false;
    }
}
