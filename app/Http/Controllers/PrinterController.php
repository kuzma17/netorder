<?php

namespace App\Http\Controllers;

use App\Cartridge;
use App\Printer;
use Illuminate\Http\Request;
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
        $printer = new Printer();
        $this->validate($request, $printer->rules );
        $printer->name = $request->name;
        $printer->save();
        $printer->cartridges()->sync($request->cartridge);

        Session::flash('ok_message', 'Принтер успешно создан.');

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
        $cartList = Cartridge::all();
        return view('printers.edit', ['printer'=>$printer, 'cartList'=>$cartList]);
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
}
