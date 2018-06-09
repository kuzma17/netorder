<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Client extends Model
{
    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ];

    public function firm(){
        return $this->belongsTo(Firm::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function town(){
        return $this->belongsTo(Town::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function list_firms(){
        return Firm::where('status', 'on')->orderBy('name')->get();
    }

    public function list_regions(){
        return Region::orderBy('name')->get();
    }

    public function list_towns(){
        return Town::orderBy('name')->get();
    }

    public function list_users(){
        return User::orderBy('name')->get();
    }

    public function list_contractors(){
        return Contractor::where('status', 'on')->orderBy('name')->get();
    }
}
