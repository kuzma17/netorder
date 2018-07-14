<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\Printer;
use App\Region;
use App\Town;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PrinterController extends Maincontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $printers = Printer::paginate($this->setting->get_param('paginate'));
        return view('printers.index', ['printers'=>$printers, 'setting'=>$this->setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create', Printer::class)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        return view('printers.create', ['setting'=>$this->setting]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('store', Printer::class)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($this->check_double($request->name)) {
            $printer = new Printer();
            $this->validate($request, $printer->rules);
            $printer->name = $request->name;
            $printer->save();
            $printer->cartridges()->sync($request->cartridge);

            Session::flash('ok_message', 'Принтер успешно создан.');
        }

        return redirect(route('printers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $printer = Printer::find($id);
        return view('printers.show', ['printer'=>$printer, 'setting'=>$this->setting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $printer = Printer::find($id);
        if(Gate::denies('edit', $printer)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        return view('printers.edit', ['printer'=>$printer, 'setting'=>$this->setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $printer = Printer::find($id);

        if(Gate::denies('update', $printer)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $this->validate($request, $printer->rules );
        $printer->name = $request->name;
        $printer->save();
        $printer->cartridges()->sync($request->cartridge);

        Session::flash('ok_message', 'Принтер успешно обновлен.');

        return redirect(route('printers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){

        $printer = Printer::find($id);
        if(Gate::denies('delete', $printer)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }
        $printer->delete();
        $printer->cartridges()->detach();
        return redirect(route('printers.index'))->with('info_message', 'Принтер успешно удален.');;
    }

    public function check_double($name){
        if(Printer::where('name', $name)->exists()){
            Session::flash('error_message', 'Такой принтер уже существует в базе! Попробуйте ввести другое наименование');
            return false;
        }
        return true;
    }


    // Upload price

    public function load_printers(){
        return view('/printers/load_printers', ['setting'=>$this->setting]);
    }

    public function save_load_printers(Request $request){

        $f = '/home/kuzma/city.csv';

        $row = 1;
        if (($handle = fopen($f, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                echo "<p> $num полей в строке $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    $data[$c] = trim($data[$c]);
                    if($data[$c]) {
                      //  echo $data[$c] . "<br />";

                        $id_cartridge = [];

                       // if($c == 0){
                         //   if (!Printer::where('name', $data[$c])->exists()) {
                           //     $printer = new Printer();
                             //   $printer->name = $data[$c];
                              //  $printer->save();
                            //}
                       // }

                        //if($c > 0){
                          //  if (!Cartridge::where('name', $data[$c])->exists()) {
                            //    $cartridge = new Cartridge();
                              //  $cartridge->name = $data[$c];
                              // $cartridge->save();
                           // }
                        //}
                        //if($c >0){
                        //    $id_cart = Cartridge::where('name', $data[$c])->first()->id;
                        //    $id_print = Printer::where('name', $data[0])->first()->id;

                        //    DB::insert('insert into cartridge_printer (printer_id, cartridge_id) values (?, ?)', [$id_print, $id_cart]);
                        //}

                      // if($c ==0){
                          // $id = Town::where('name', $data[0])->first()->id;
                          // $region_id = Region::where('name', $data[1])->first()->id;

                      //  $town = Town::find($id);
                       // $town->region_id = $region_id;
                      //  $town->save();

                           ///echo $id.' '.$region_id.'<br>';
                      // }
                      //  if($c ==1){
                       //     if (!Region::where('name', $data[$c])->exists()) {
                       //         $town = new Region();
                        //        $town->name = $data[$c];
                        //        $town->save();
                       //     }
                       // }

                    }
                }
            }
            echo 'complete';
            fclose($handle);
        }

    }
}
