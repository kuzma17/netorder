<?php

namespace App\Http\Controllers;

use App\Client;
use App\Equipment;
use Gate;
use Illuminate\Http\Request;
use Session;

class ClientController extends Controller
{
    public function list(){
        $clients = Client::orderBy('updated_at', 'desc')->paginate(20);;
        return view('clients.list', ['clients'=>$clients]);
    }

    public function view($id){
        $client = Client::find($id);
        return view('clients.view', ['client'=>$client]);
    }

    public function add(Request $request){

        $client = new Client();

        if(Gate::denies('add', $client)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $client->rules );

            $client->firm_id = $request->firm;
            $client->region_id = $request->region;
            $client->town_id = $request->town;
            $client->contractor_id = $request->contractor;
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();

            if(count($request->equipment) > 0) {
                $equipments = [];
                foreach ($request->equipment as $item) {
                    $equipments[] = new Equipment(['name' => $item]);
                }
                $client->equipments()->saveMany($equipments);
            }

            Session::flash('ok_message', 'Офис успешно создан.');
            Session::flash('info_message', 'Необходимо создать пользователя, ответственного за данный офис в разделе пользователи.');

            return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.add', ['client'=>$client]);
    }

    public function edit(Request $request, $id){

        $client = Client::find($id);

        if(Gate::denies('edit', $client)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $client->rules );

            $client->firm_id = $request->firm;
            $client->region_id = $request->region;
            $client->town_id = $request->town;
            $client->contractor_id = $request->contractor;
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();

            if(count($request->equipment) > 0) {
                $client->equipments()->delete();
                $equipments = [];
                foreach ($request->equipment as $item) {
                    $equipments[] = new Equipment(['name' => $item]);
                }
                $client->equipments()->saveMany($equipments);
            }

            Session::flash('ok_message', 'Филиал успешно отредактирован.'.count($request->equipment));

            return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.edit', ['client'=>$client]);
    }

    public function del($id){

        $client = Client::find($id);

        if(Gate::denies('del', $client)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $client->delete();
        Session::flash('ok_message', 'Филиал успешно удален.');
        return redirect(route('firms'));
    }
}
