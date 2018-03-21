<?php

namespace App\Http\Controllers;

use App\Contractor;
use Gate;
use Illuminate\Http\Request;
use Session;

class ContractorController extends Controller
{
    public function list(){
        $contractors = Contractor::orderBy('updated_at', 'desc')->paginate(1);;
        return view('contractors.list', ['contractors'=>$contractors]);
    }

    public function add(Request $request){

        $contractor = new Contractor();

        if(Gate::denies('add', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $contractor->rules );

            $contractor->user_id = $request->user;
            $contractor->name = $request->name;
            $contractor->full_name = $request->full_name;
            $contractor->phone = $request->phone;
            $contractor->address = $request->address;
            $contractor->status = $request->status;
            $contractor->save();

            Session::flash('ok_message', 'Contractor created.');

            return redirect(route('contractors'));
        }

        return view('contractors.add', ['contractor' => $contractor]);
    }

    public function edit(Request $request, $id){

        $contractor = Contractor::find($id);

        if(Gate::denies('edit', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $contractor->rules);

            $contractor->user_id = $request->user;
            $contractor->name = $request->name;
            $contractor->full_name = $request->full_name;
            $contractor->phone = $request->phone;
            $contractor->address = $request->address;
            $contractor->status = $request->status;
            $contractor->save();

            Session::flash('ok_message', 'Contractor edited');

            return redirect(route('contractors'));
        }

        return view('contractors.edit', ['contractor'=>$contractor]);
    }

    public function del($id){

        $contractor = Contractor::find($id);

        if(Gate::denies('del', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $contractor->delete();
        Session::flash('ok_message', 'Contractor deleted');
        return redirect(route('contractors'));
    }
}
