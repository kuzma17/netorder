<?php

namespace App;

use DB;
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

    public function addPrinterOrder($request, $order_id){
        $fields = [];
        foreach ($request->printer as $printer){
            if($request->cartridge){
                foreach ($request->cartridge[$printer] as $key=>$val){
                    $fields[] = [
                        'order_id' => $order_id,
                        'printer_id' => $printer,
                        'cartridge_id' => $val,
                        'quantity' => $request->count_cartridge[$printer][$key]
                    ];
                }
            }else{
                $fields[] = [
                    'order_id' => $order_id,
                    'printer_id' => $printer,
                    'cartridge_id' => 0,
                    'quantity' => 0
                ];
            }
        };

        DB::table('order_printer')->insert($fields);
    }

    public function updatePrinterOrder($request, $order_id){
        //
    }

    public function showPrinterOrder($order_id){
        $printers = DB::table('order_printer')->where('options->language', 'en')->get();
        return $printers;
    }

    public function delPrinterOrder($order_id){
        DB::table('order_printer')->where('order_id', $order_id)->delete();
    }
}
