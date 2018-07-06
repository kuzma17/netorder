<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\Price;
use App\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $printers = Printer::paginate(20);
        return view('printers.index', ['printers'=>$printers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('printers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return view('printers.show', ['printer'=>$printer]);
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
        return view('printers.edit', ['printer'=>$printer]);
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
        return view('/printers/load_printers');
    }

    public function save_load_printers(Request $request){

        $f = '/home/kuzma/printers.csv';

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
                        if($c >0){
                            $id_cart = Cartridge::where('name', $data[$c])->first()->id;
                            $id_print = Printer::where('name', $data[0])->first()->id;

                            DB::insert('insert into cartridge_printer (printer_id, cartridge_id) values (?, ?)', [$id_print, $id_cart]);
                        }

                    }
                }
            }
            fclose($handle);
        }

    }
}
