<?php

namespace App\Http\Controllers;

use App\Firm;
use Gate;
use Illuminate\Http\Request;
use Session;

class FirmController extends Maincontroller
{
    public function list($id = 0){
        $firms = Firm::orderBy('updated_at', 'asc')->paginate($this->setting->get('paginate'));
        return view('firms.list', ['firms'=>$firms, 'id'=>$id, 'setting'=>$this->setting]);
    }

    public function view($id){
        $firm = Firm::find($id);
        return view('firms.view', ['firm'=>$firm, 'setting'=>$this->setting]);
    }

    public function add(Request $request){

        $Firm = new Firm();

        if(Gate::denies('add', $Firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $Firm->rules );

            $Firm->name = $request->name;
            $Firm->phone = $request->phone;
            $Firm->email = $request->email;
            $Firm->status = $request->status;
            $Firm->save();

            Session::flash('ok_message', 'Организация успешно создана.');
            Session::flash('info_message', 'Необходимо создать хотя-бы 1 филиал. Можно также создать для организации администратора предприятия в разделе пользователи.');

            return redirect(route('firms'));
        }

        return view('firms.add', ['setting'=>$this->setting]);
    }

    public function edit(Request $request, $id){

        $firm = Firm::find($id);

        if(Gate::denies('edit', $firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $firm->rules);

            $firm->name = $request->name;
            $firm->phone = $request->phone;
            $firm->email = $request->email;
            $firm->status = $request->status;
            $firm->save();

            Session::flash('ok_message', 'Организация успешно отредактирована.');

            return redirect(route('firms'));
        }

        return view('firms.edit', ['firm'=>$firm, 'setting'=>$this->setting]);
    }

    public function del($id){

        $firm = Firm::find($id);

        if(Gate::denies('del', $firm)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $firm->delete();
        Session::flash('ok_message', 'Организация успешно удалена.');
        return redirect(route('firms'));
    }
}
