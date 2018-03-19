<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Session;

class ClientController extends Controller
{
    public function list(){
        $clients = Client::orderBy('updated_at', 'desc')->paginate(1);;
        return view('clients.list', ['clients'=>$clients]);
    }

    public function add(Request $request){

        $client = new Client();

        if($request->isMethod('post')){

            $this->validate($request, $client->rules );

            $client->firm_id = $request->firm;
            $client->region_id = $request->region;
            $client->town_id = $request->town;
            $client->user_id = $request->user;
            $client->name = $request->name;
            $client->full_name = $request->full_name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();

            Session::flash('ok_message', 'Client created.');

            return redirect(route('clients'));
        }

        return view('clients.add', ['client'=>$client]);
    }

    public function edit(Request $request, $id){

        $client = Client::find($id);

        if($request->isMethod('post')){

            $this->validate($request, $client->rules );

            $client->firm_id = $request->firm;
            $client->region_id = $request->region;
            $client->town_id = $request->town;
            $client->user_id = $request->user;
            $client->name = $request->name;
            $client->full_name = $request->full_name;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->status = $request->status;
            $client->save();

            Session::flash('ok_message', 'Client update.');

            return redirect(route('clients'));
        }

        return view('clients.edit', ['client'=>$client]);
    }

    public function del($id){
        $firm = Client::find($id);
        $firm->delete();
        Session::flash('ok_message', 'Client deleted');
        return redirect(route('clients'));
    }
}
