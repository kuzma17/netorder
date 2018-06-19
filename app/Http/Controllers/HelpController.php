<?php

namespace App\Http\Controllers;

use App\Firm;
use App\Help;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function help(){
        $role = \Auth::user()->profile->role->label;
        $text = Help::where('role', $role)->first();
        return view('help', ['text'=>$text]);
    }
}
