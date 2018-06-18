<?php

namespace App\Http\Controllers;

use App\Firm;
use DB;
use Gate;
use Illuminate\Http\Request;
use Session;

class FirmController extends Controller
{
    public function list($id = 0){
        $firms = Firm::orderBy('updated_at', 'asc')->paginate(20);
        //$firms = DB::table('firms')
          //  ->select('firms.id as firm_id', 'firms.name as firm', 'firms.status as firm_status',
           //     'clients.id as client_id', 'clients.name as client', 'clients.status as client_status')
           // ->leftJoin('clients', 'firms.id', '=', 'clients.firm_id')
           // ->orderBy('firm_id', 'asc')
           // ->orderBy('client_id', 'asc')
           // ->get();
       // $list = [];

        //foreach ($firms as $firm){
            //$list[$firm->id]['name'] = $firm->name;
            //$list[$firm->id]['status'] = $firm->status;
           // echo $firm->id.'<br>';
          //  dd($firm->clients);
          // echo '<br>';
        //}

        //dd($firms);

        return view('firms.list', ['firms'=>$firms, 'id'=>$id]);
    }

    public function view($id){
        $firm = Firm::find($id);
        return view('firms.view', ['firm'=>$firm]);
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
            $Firm->status = $request->status;
            $Firm->save();

            Session::flash('ok_message', 'Организация успешно создана.');
            Session::flash('info_message', 'Необходимо создать хотя-бы 1 филиал.');

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
            $firm->phone = $request->phone;
            $firm->status = $request->status;
            $firm->save();

            Session::flash('ok_message', 'Организация успешно отредактирована.');

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
        Session::flash('ok_message', 'Организация успешно удалена.');
        return redirect(route('firms'));
    }
}
