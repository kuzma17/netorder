<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class Maincontroller extends Controller
{
    protected $setting;

    public function __construct(Setting $setting){
        return $this->setting = $setting;
    }
}
