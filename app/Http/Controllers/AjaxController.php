<?php

namespace App\Http\Controllers;

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
            $htm .= '<option value="">Выберите филиал</option>';
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
}
