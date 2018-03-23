<?php

namespace App\Http\Controllers;

use App\Firm;
use Gate;
use Illuminate\Http\Request;
use Session;

class FirmController extends Controller
{
    public function list(){
        $firms = Firm::orderBy('updated_at', 'desc')->paginate(20);
        return view('firms.list', ['firms'=>$firms]);
    }

    public function add(Request $request){

        $Firm = new Firm();

        if(Gate::denies('add', $Firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $Firm->rules );

            $Firm->name = $request->name;
            $Firm->full_name = $request->full_name;
            $Firm->phone = $request->phone;
            $Firm->status = $request->status;
            $Firm->save();

            Session::flash('ok_message', 'Firm created.');

            return redirect(route('firms'));
        }

        return view('firms.add');
    }

    public function edit(Request $request, $id){

        $firm = Firm::find($id);

        if(Gate::denies('edit', $firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $firm->rules);

            $firm->name = $request->name;
            $firm->full_name = $request->full_name;
            $firm->phone = $request->phone;
            $firm->status = $request->status;
            $firm->save();

            Session::flash('ok_message', 'Firm edited');

            return redirect(route('firms'));
        }

        return view('firms.edit', ['firm'=>$firm]);
    }

    public function del($id){

        $firm = Firm::find($id);

        if(Gate::denies('del', $firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $firm->delete();
        Session::flash('ok_message', 'Firm deleted');
        return redirect(route('firms'));
    }
}
