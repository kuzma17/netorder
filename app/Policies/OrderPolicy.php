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
        if($user->is_client()){
            return true;
        }
        return false;
    }

    public function edit(User $user, Order $order){
        if($user->is_admin()){
            return true;
        }
        if($user->is_client() && $order->status->label == 'wait'){
            return true;
        }
        if($user->is_contractor()){
            return true;
        }
        return false;
    }

    public function del(User $user, Order $order){
        if($user->is_admin()){
            return true;
        }
        if($user->is_client() && $order->status->label == 'wait'){
            return true;
        }
        return false;
    }

    public function editTypeWork(User $user, Order $order){
        if($user->is_client()){
            if($order->status->label == 'wait'){
                return false;
            }
        }
        if($user->is_contractor() || $user->is_admin()){
            if($order->status->label == 'work' || $order->status->label == 'diagnostic'){
                return false;
            }
        }
        return true;
    }
}
