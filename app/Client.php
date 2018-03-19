<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Client extends Model
{
    public $rules = [
        'name' => 'required',
        'full_name' => 'required',
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

    public function firms(){
        return Firm::where('status', 'on')->get();
    }

    public function regions(){
        return Region::all();
    }

    public function towns(){
        return Town::all();
    }

    public function users(){
        return User::all();
    }
}
