<?php

namespace App\Http\Controllers;

use App\Cartridge;
use Illuminate\Http\Request;
use Session;

class CartridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartridges = Cartridge::paginate(20);
        return view('cartridges.index', ['cartridges'=>$cartridges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cartridges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartridge = new Cartridge();
        $this->validate($request, $cartridge->rules );
        $cartridge->name = $request->name;
        $cartridge->save();

        Session::flash('ok_message', 'Картридж успешно создан.');

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
        return view('cartridges.edit', ['cartridge'=>$cartridge]);
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

        $cartridge->delete();
        return redirect(route('cartridges.index'))->with('info_message', 'Картридж успешно удален.');;
    }
}
