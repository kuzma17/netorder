<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\Client;
use App\Contractor;
use App\Firm;
use App\Printer;
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
            //$htm .= '<option value="">Выберите офис</option>';
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
}
