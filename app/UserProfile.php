<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['role_id', 'name', 'phone', 'firm_id', 'branch_id', 'status'];

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
