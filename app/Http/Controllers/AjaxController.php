<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\Client;
use App\Contractor;
use App\Firm;
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
            $htm .= '<option value="">Выберите офис</option>';
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
            $htm .= '<option value="">Выберите организацию</option>';
            foreach ($contractors as $contractor) {
                $htm .= '<option value="' . $contractor->id . '">' . $contractor->name . '</option>';
            }
        }
        return $htm;
    }

    public function cartridge_list(){
        $htm = '';
        $cartridges = Cartridge::orderBy('name')->get();
        if(count($cartridges) > 0) {
            $htm = '<div class="form-group cartridge">
            <label class="col-md-3 control-label">Картридж</label>
            <div class="col-md-8"><select class="form-control" name="cartridge[]">';
            foreach ($cartridges as $cartridge) {
                $htm .= '<option value="' . $cartridge->id . '">' . $cartridge->name . '</option>';
            }
            $htm .= '</select></div>
                    <div class="col-md-1" ><a href = "#" class="cartridge_del" title = "Удалить картридж" ><i class="fa fa-times red" ></i ></a ></div>
            </div>';
        }
        return $htm;
    }
}
