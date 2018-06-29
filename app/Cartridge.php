<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartridge extends Model
{
    protected $table = 'cartridges';

    public $rules = [
        'name' => 'required',
    ];
}
