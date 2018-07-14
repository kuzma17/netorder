<?php

namespace App\Http\Controllers;

use App\Contractor;
use Gate;
use Illuminate\Http\Request;
use Session;

class ContractorController extends Maincontroller
{
    public function index(){
        $contractors = Contractor::active()->orderBy('updated_at', 'desc')->paginate($this->setting->get_param('paginate'));
        return view('contractors.list', ['contractors'=>$contractors, 'setting'=>$this->setting]);
    }

    public function show($id){
        $contractor = Contractor::find($id);
        return view('contractors.view', ['contractor'=>$contractor, 'setting'=>$this->setting]);
    }

    public function create(){
        if(Gate::denies('add', Contractor::class)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }
        return view('contractors.add', ['setting'=>$this->setting]);
    }

    public function store(Request $request){

        $contractor = new Contractor();

        if(Gate::denies('add', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $this->validate($request, $contractor->rules );

       // $contractor->name = $request->name;
       // $contractor->phone = $request->phone;
       // $contractor->address = $request->address;
        //$contractor->status = $request->status;
        $contractor->fill($request->all());
        $contractor->save();

        Session::flash('ok_message', 'Подрядчик успешно создан.');

        return redirect(route('contractors.index'));
    }

    public function edit($id){
        $contractor = Contractor::find($id);
        if(Gate::denies('edit', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }
        return view('contractors.edit', ['contractor'=>$contractor, 'setting'=>$this->setting]);
    }

    public function update(Request $request, $id){

        $contractor = Contractor::find($id);

        if(Gate::denies('edit', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $this->validate($request, $contractor->rules);

       // $contractor->name = $request->name;
      //  $contractor->phone = $request->phone;
       // $contractor->address = $request->address;
      //  $contractor->status = $request->status;

        $contractor->fill($request->all());
        $contractor->save();

            Session::flash('ok_message', 'Подрядчик успешно изменен.');

            return redirect(route('contractors.index'));
    }

    public function delete($id){

        $contractor = Contractor::find($id);

        if(Gate::denies('del', $contractor)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $contractor->delete();
        return redirect(route('contractors.index'))->with('info_message', 'Подрядчик успешно удален.');;
    }
}
