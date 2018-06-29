<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    public $rules = [
        'name' => 'required',
    ];

    public function cartridges(){
        return $this->belongsToMany(Cartridge::class);
    }
}
