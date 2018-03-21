<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    public $rules = [
        'name' => 'required',
        'full_name' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return User::all();
    }
}