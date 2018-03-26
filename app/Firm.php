<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public $rules = [
        'name' => 'required',
        'phone' => 'required',
    ];

    public function clients(){
        return $this->hasMany(Client::class);
    }
}
