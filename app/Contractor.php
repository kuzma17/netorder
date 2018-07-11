<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'status'];

    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|string|email|max:255',
        'address' => 'required'
    ];

    public function userProfiles(){
        return $this->hasMany(UserProfile::class);
    }

    public function scopeActive($request){
        $request->where(['status'=>'on']);
    }
}
