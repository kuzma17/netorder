<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Request;

class Order extends Model
{
    use Notifiable;

    public $rules = [
        'type_work' => 'required',
        'date_end' => 'required',
    ];

    public function typeWork(){
        return $this->belongsTo(TypeWork::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function firm(){
        return $this->belongsTo(Firm::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function contractor(){
        return $this->belongsTo(Contractor::class);
    }

    public function typeWorks(){
        return TypeWork::all();
    }

    public function contractors(){
        return Contractor::where('status', 'on')->get();
    }

    public function statuses(){
        return Status::all();
    }

    public function printer(){
        return $this->belongsTo(Printer::class);
    }

    public function cartridge(){
        return $this->belongsTo(Cartridge::class);
    }

    public function routeNotificationForMail(){
        return $this->contractor->email;
    }
}
