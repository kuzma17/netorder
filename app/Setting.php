<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $rules = [
        'phone' => 'required',
        'email' => 'required|string|email|max:255',
        'paginate' => 'required|numeric'
    ];

   public static function get($key){
       return Setting::find($key)->value;
   }

   public function set($key, $val){
       $setting = Setting::find($key);
       $setting->value = trim($val);
       $setting->save();
   }
}