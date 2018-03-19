<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'label'
    ];

    public function users(){
        require $this->belongsToMany(User::class);
    }
}
