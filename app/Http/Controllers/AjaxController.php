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
        $htm = '';
        $cartridges = Cartridge::orderBy('name')->get();
        if(count($cartridges) > 0) {
            $htm = '<div class="form-group cartridge">
            <label class="col-md-3 control-label">Картридж</label>
            <div class="col-md-8"><select class="form-control select_cartridge" name="cartridge[]">';
            foreach ($cartridges as $cartridge) {
                if (count($select_cartridges) > 0 && in_array($cartridge->id, $select_cartridges)) {
                    continue;
                }
                $htm .= '<option value="' . $cartridge->id . '">' . $cartridge->name . '</option>';
            }
            $htm .= '</select></div>
                    <div class="col-md-1" ><a href = "#" class="cartridge_del" title = "Удалить картридж" ><i class="fa fa-times red" ></i ></a ></div>
            </div>';
        }
        return $htm;
    }

    public function cartridge_order(Request $request){
        $printer_id = $request->printer;
        $printer = Printer::find($printer_id);
        $cartridges = $printer->cartridges;
        $htm = '';
        if(count($cartridges) > 0) {
            $htm = '<div class="form-group cartridge">
            <label class="col-md-3 control-label">Картридж</label>
            <div class="col-md-9">
            <select class="form-control select_cartridge" name="cartridge" required>';
            foreach ($cartridges as $cartridge) {
                $htm .= '<option value="' . $cartridge->id . '">' . $cartridge->name . '</option>';
            }
            $htm .= '</select>
                </div>
            </div>
             <div class="form-group">
                               <label class="col-md-3 control-label">Количество картриджей</label>
                               <div class="col-md-9">
                                   <input type="number" name="count_cartridge" class="form-control select_cartridge" value="1" required>
                               </div>
                           </div>';
        }
        return $htm;
    }

    public function add_printer(Request $request){

        $select_printers = $request->printers;
        $printers = Printer::orderBy('name')->get();

        $htm = '<div class="printer">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Модель принтера</label>
                        <div class="col-md-8">
                            <select class="form-control select_printer" name="printer[]" required>
                            <option value="">Выберите модель принтера</option>';
        foreach ($printers as $printer) {
            if (count($select_printers) > 0 && in_array($printer->id, $select_printers)) {
                continue;
            }

            $htm .= '<option value="' . $printer->id . '">' . $printer->name . '</option>';
        }

        $htm .= '</select>
                 </div>
                        <div class="col-md-1">
                            <a href="#" class="equipment_del" title="Удалить принтер"><i class="fa fa-trash red"></i></a>
                        </div> 
                     </div> 
                    <div class="regenerate"> 
                    </div> 
                        <div class="row head_cartridges">
                            <div class="col-md-7"></div>
                            <div class="col-md-2"><p class="small">заправка</p></div>
                            <div class="col-md-2"><p class="small">восстановление</p></div>
                        </div>    
            </div>';

        return $htm;
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
