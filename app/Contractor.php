<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'status'];

    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeActive($request){
        $request->where(['status'=>'on']);
    }
}
