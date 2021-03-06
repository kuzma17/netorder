<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Client extends Model
{
    public $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required|string|email|max:255',
        'address' => 'required'
    ];

    public function firm(){
        return $this->belongsTo(Firm::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contractor(){
        return $this->belongsTo(Contractor::class);
    }

    public function printers(){
        return $this->belongsToMany(Printer::class);
    }

    public function prices(){
        return $this->hasMany(Price::class);
    }

    public function save_prices($request){
        $this->prices()->delete();
        $prices = [];
        foreach ($request->printer as $printer){
            foreach ($request->cartridge[$printer] as $cartridge){
                $cost = $request->price[$printer][$cartridge];
                $cost2 = $request->price2[$printer][$cartridge];
                $prices[] = new Price([
                    'printer_id' => $printer,
                    'cartridge_id'=>$cartridge,
                    'price'=>$cost,
                    'price2'=>$cost2
                ]);
            }
        }
        $this->prices()->saveMany($prices);
    }

    public function price($printer_id, $cartridge_id){
        return $this->prices()->where([
            'printer_id'=>$printer_id,
            'cartridge_id'=>$cartridge_id
        ])->first();
    }

    public function price2($client_id, $printer_id, $cartridge_id){
        return Price::where([
            'client_id' => $client_id,
            'printer_id'=>$printer_id,
            'cartridge_id'=>$cartridge_id
        ])->get();
    }

    public function list_firms(){
        return Firm::where('status', 'on')->orderBy('name')->get();
    }

    public function list_regions(){
        return Region::orderBy('name')->get();
    }

    public function list_cites($id){
        return City::where('region_id', $id)->orderBy('name')->get();
    }

    public function list_users(){
        return User::orderBy('name')->get();
    }

    public function list_contractors(){
        return Contractor::where('status', 'on')->orderBy('name')->get();
    }
}
