<?php

namespace App\Http\Controllers;

use App\Client;
use App\Price;
use App\Printer;
use Gate;
use Illuminate\Http\Request;
use Session;

class ClientController extends Maincontroller
{
    public function list(){
        $clients = Client::orderBy('updated_at', 'desc')->paginate(20);
        return view('clients.list', ['clients'=>$clients, 'setting'=>$this->setting]);
    }

    public function view($id){
        $client = Client::find($id);
        return view('clients.view', ['client'=>$client, 'setting'=>$this->setting]);
    }

    public function add(Request $request){

        $client = new Client();

        if(Gate::denies('add', $client)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, $client->rules );

            if(!$request->printer){
                return redirect()->back()->with('error_message', 'Необходимо добавить минимум один принтер на вкладке "Принтеры"!');
            }

            $client->firm_id = $request->firm;
            $client->region_id = $request->region;
            $client->city_id = $request->city;
            $client->contractor_id = $request->contractor;
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();
            $client->printers()->sync($request->printer);
            $client->save_prices($request);

            Session::flash('ok_message', 'Офис успешно создан.');
            Session::flash('info_message', 'Необходимо создать пользователя, ответственного за данный офис в разделе пользователи.');

            return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.add', ['client'=>$client, 'setting'=>$this->setting]);
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
            $client->city_id = $request->city;
            $client->contractor_id = $request->contractor;
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();
            $client->printers()->sync($request->printer);
            $client->save_prices($request);

            Session::flash('ok_message', 'Офис успешно отредактирован.');

            return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.edit', ['client'=>$client, 'setting'=>$this->setting]);
    }

    public function del($id){

        $client = Client::find($id);

        if(Gate::denies('del', $client)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $client->printers()->detach();
        $client->prices()->delete();
        $client->delete();
        Session::flash('ok_message', 'Филиал успешно удален.');
        return redirect(route('firms'));
    }
}
