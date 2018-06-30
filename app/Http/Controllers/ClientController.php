<?php

namespace App\Http\Controllers;

use App\Client;
use App\Equipment;
use App\Price;
use App\Printer;
use Gate;
use Illuminate\Http\Request;
use Session;

class ClientController extends Controller
{
    public function list(){
        $clients = Client::orderBy('updated_at', 'desc')->paginate(20);
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
            $client->printers()->sync($request->printer);

            $prices = [
                new Price(['printer_id' => 1, 'cartridge_id'=>1, 'price'=>100]),
                new Price(['printer_id' => 2, 'cartridge_id'=>1, 'price'=>110]),
            ];


            $client->prices()->saveMany($prices);

            Session::flash('ok_message', 'Офис успешно создан.');
            Session::flash('info_message', 'Необходимо создать пользователя, ответственного за данный офис в разделе пользователи.');

            return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.add', ['client'=>$client]);
    }

    public function edit(Request $request, $id){

        $client = Client::find($id);
        $allPrinters = Printer::orderBy('name')->get();

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
            $client->printers()->sync($request->printer);

            //dd($request);

            $client->prices()->delete();

            $prices = [];
            foreach ($request->printer as $printer){
                foreach ($request->cartridge[$printer] as $cartridge){
                    $cost = $request->price[$printer][$cartridge];
                    $prices[] = new Price([
                        'printer_id' => $printer,
                        'cartridge_id'=>$cartridge,
                        'price'=>$cost
                    ]);

                   //echo $printer.' '.$cartridge.' '.$cost.'<br>';
                }
            }

            $client->prices()->saveMany($prices);

            //Session::flash('ok_message', 'Филиал успешно отредактирован.'.count($request->equipment));

           // return redirect(route('firms.id', $client->firm_id));
        }

        return view('clients.edit', ['client'=>$client, 'allPrinters'=>$allPrinters]);
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
