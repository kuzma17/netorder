<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function cites(){
        return $this->hasMany(City::class);
    }
}
