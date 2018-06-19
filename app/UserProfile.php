<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['role_id', 'name', 'phone', 'firm_id', 'branch_id', 'status'];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function contractor(){
        return $this->belongsTo(Contractor::class, 'firm_id', 'id');
    }

    public function firm(){
        return $this->belongsTo(Firm::class);
    }

    public function client(){
        return $this->belongsTo(Client::class, 'branch_id', 'id');
    }
}
