<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\City;
use App\Client;
use App\Contractor;
use App\Firm;
use App\Printer;
use App\Region;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax_firm(){
        $htm = '';
        $firms = Firm::where('status', 'on')->orderBy('name')->get();
        if(count($firms) > 0) {
            $htm .= '<option value="">Выберите организацию</option>';
            foreach ($firms as $firm) {
                $htm .= '<option value="' . $firm->id . '">' . $firm->name . '</option>';
            }
        }
        return $htm;
    }

    public function branch_list(Request $request){
        $id = $request->id;
        $htm = '';
        $branches = Client::where('firm_id', $id)->where('status', 'on')->orderBy('name')->get();
        if(count($branches) > 0) {
            $htm .= '<option value=""></option>';
            foreach ($branches as $branch) {
                $htm .= '<option value="' . $branch->id . '">' . $branch->name . '</option>';
            }
        }
        return $htm;
    }

    public function contractor_list(){
        $htm = '';
        $contractors = Contractor::where('status', 'on')->orderBy('name')->get();
        if(count($contractors) > 0) {
            //$htm .= '<option value="">Выберите организацию</option>';
            foreach ($contractors as $contractor) {
                $htm .= '<option value="' . $contractor->id . '">' . $contractor->name . '</option>';
            }
        }
        return $htm;
    }

    public function cartridge_list(Request $request){
        $select_cartridges = $request->cartridges;
        $cartridges = Cartridge::orderBy('name')->get();
        if(count($cartridges) > 0) {
            return view('cartridges.cartridge_list', ['cartridges'=>$cartridges, 'select_cartridges'=>$select_cartridges]);
        }
    }

    public function cartridge_order(Request $request){
        $printer_id = $request->printer;
        $printer = Printer::find($printer_id);
        $cartridges = $printer->cartridges;
        if(count($cartridges) > 0) {
           return view('order.cartridge_order', ['cartridges'=>$cartridges]);
        }
    }

    public function add_printer(Request $request){
        $select_printers = $request->printers;
        $printers = Printer::orderBy('name')->get();
        return view('printers.add_printer', ['printers'=>$printers, 'select_printers'=>$select_printers]);
    }

    public function add_cartridge(Request $request){
        $printer_id = $request->printer;
        $printer = Printer::find($printer_id);
        $cartridges = $printer->cartridges;
        if(count($cartridges) > 0){
            $htm = view('cartridges.add_cartridge', ['cartridges'=>$cartridges, 'printer_id'=>$printer_id]);
            return $htm;
        }
    }

    public function search_cartridge(Request $request){
        $search = $request->search;
        $cartridges = Cartridge::where('name', 'like', '%'.$search.'%')->get();
        return view('cartridges.table', ['cartridges'=>$cartridges]);
    }

    public function search_printer(Request $request){
        $search = $request->search;
        $printers = Printer::where('name', 'like', '%'.$search.'%')->get();
        return view('printers.table', ['printers'=>$printers]);
    }

    public function search_city(Request $request){
        $search = $request->search;
        $cites = City::where('name', 'like', '%'.$search.'%')->get();
        return view('cites.table', ['cites'=>$cites]);
    }

    public function city_list(Request $request){
        $region_id = $request->region;
        $region = Region::find($region_id);
        $cites = $region->cites;
        if(count($cites) > 0){
            $htm = '';
            foreach($cites as $city){
                $htm .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
            return $htm;
        }
    }

    public function add_order_printer(Request $request){
        $user = \Auth::user();
        $printers = $user->profile->client->printers;
        return view('order.select_printer', ['printers' => $printers]);
    }

    public function add_order_printer2(Request $request){
        $user = \Auth::user();
        $select_printers = $request->printers;
        $printers = $user->profile->client->printers;
        if((count($printers) - count($select_printers)) > 1) {
            $add = 1;
        }else{
            $add = 0;
        }
        $htm = view('order.select_printer2', ['printers' => $printers, 'select_printers'=>$select_printers])->render();
        return response()->json(['add'=> $add, 'htm'=>$htm]);
    }

    public function add_order_cartridge(Request $request){
        $printer_id = $request->printer;
        $select_cartridges = $request->cartridges;

        $cartridges = Printer::find($printer_id)->cartridges;
        if((count($cartridges) - count($select_cartridges)) > 1) {
            //$htm = view('order.select_cartridge', ['cartridges' => $cartridges, 'select_cartridges' => $select_cartridges])->render();
            $add = 1;
        }else{
           // $htm = view('order.input_cartridge', ['cartridge' => $cartridges[0]])->render();
            $add = 0;
        }
        $htm = view('order.select_cartridge', ['cartridges' => $cartridges, 'select_cartridges' => $select_cartridges])->render();
        return response()->json(['add'=> $add, 'htm'=>$htm]);
    }
}
