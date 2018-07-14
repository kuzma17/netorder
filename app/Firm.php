<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|string|email|max:255',
    ];

    public function clients(){
        return $this->hasMany(Client::class);
    }
}
