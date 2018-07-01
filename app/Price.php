<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['client_id', 'printer_id', 'cartridge_id', 'price'];

}
