<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
   // public function roles(){
   //     return $this->belongsToMany(Role::class);
   // }

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function contractor(){
        return $this->hasOne(Contractor::class);
    }

    public function firm(){
        return $this->hasOne(Firm::class);
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

    //public function role_list(){
    //    return Role::all();
   // }

    //public function firm_list(){
      //  return Firm::all();
    //}

  //  public function branch_list($id){
    //    return Client::where('firm_id', $id)->get();
   // }

    public function is_role($role_id)
    {
        foreach ($this->roles as $role){
            if($role->id == $role_id){
                return true;
            }
        }

        return false;
    }

    public function is_admin(){
       // foreach ($this->roles as $role){
        //    if($role->label == 'admin'){
         //       return true;
           // }
        //}
        if($this->profile->role->label == 'admin'){
            return true;
        }
        return false;
    }

    public function is_admin_firm(){
       // foreach ($this->roles as $role){
      //      if($role->label == 'admin_firm'){
     //           return true;
      //      }
      //  }

        if($this->profile->role->label == 'admin_firm'){
            return true;
        }
        return false;
    }

    public function is_client(){
        //foreach ($this->roles as $role){
         //   if($role->label == 'client'){
         //       return true;
        //    }
      //  }
        if($this->profile->role->label == 'client'){
            return true;
        }

        return false;
    }

    public function is_contractor(){
        //foreach ($this->roles as $role){
         //   if($role->label == 'contractor'){
          //      return true;
           // }
        //}

        if($this->profile->role->label == 'contractor'){
            return true;
        }

        return false;
    }

}
