<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    public $rules = [
        'name' => 'required',
        'full_name' => 'required',
        'phone' => 'required',
    ];
}
