<?php

namespace App\Http\Controllers;

use App\Help;
use Illuminate\Http\Request;
use Illuminate\Notifications\Channels\MailChannel;

class HelpController extends Maincontroller
{
    public function help(){
        $role = \Auth::user()->profile->role->label;
        $text = Help::where('role', $role)->first();
        return view('help', ['text'=>$text, 'setting'=>$this->setting]);
    }
}
