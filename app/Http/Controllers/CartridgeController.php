<?php

namespace App\Http\Controllers;

use App\Cartridge;
use Gate;
use Illuminate\Http\Request;
use Session;

class CartridgeController extends Maincontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartridges = Cartridge::paginate($this->setting->get_param('paginate'));
        return view('cartridges.index', ['cartridges'=>$cartridges, 'setting'=>$this->setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // if(Gate::denies('create', Cartridge::class)){
        //    return redirect()->back()->with('error_message','Доступ запрещен.');
       // }
        return view('cartridges.create', ['setting'=>$this->setting]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // if(Gate::denies('store', Cartridge::class)){
        //    return redirect()->back()->with('error_message','Доступ запрещен.');
        //}

        if($this->check_double($request->name)) {
            $cartridge = new Cartridge();
            $this->validate($request, $cartridge->rules);
            $cartridge->name = $request->name;
            $cartridge->save();

            Session::flash('ok_message', 'Картридж успешно создан.');
        }

        return redirect(route('cartridges.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartridge = Cartridge::find($id);

       /// if(Gate::denies('edit', $cartridge)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
        //}

        return view('cartridges.edit', ['cartridge'=>$cartridge, 'setting'=>$this->setting]);
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
        $cartridge = Cartridge::find($id);

        //if(Gate::denies('update', $cartridge)){
        //    return redirect()->back()->with('error_message','Доступ запрещен.');
       // }

        $this->validate($request, $cartridge->rules );
        $cartridge->name = $request->name;
        $cartridge->save();

        Session::flash('ok_message', 'Картридж успешно изменен.');

        return redirect(route('cartridges.index'));
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

        $cartridge = Cartridge::find($id);

      //  if(Gate::denies('delete', $cartridge)){
        //    return redirect()->back()->with('error_message','Доступ запрещен.');
        //}

        $cartridge->delete();
        return redirect(route('cartridges.index'))->with('info_message', 'Картридж успешно удален.');;
    }

    public function check_double($name){
        if(Cartridge::where('name', $name)->exists()){
            Session::flash('error_message', 'Такой картридж уже существует в базе! Попробуйте ввести другое наименование');
            return false;
        }
        return true;
    }
}
