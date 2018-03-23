<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['name', 'phone', 'firm_id', 'branch_id', 'status'];
}
