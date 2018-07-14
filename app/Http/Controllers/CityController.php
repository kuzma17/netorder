<?php

namespace App\Http\Controllers;

use App\City;
use App\Region;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Session;

class CityController extends Maincontroller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cites = City::paginate($this->setting->get('paginate'));
        return view('cites.index', ['cites'=>$cites, 'setting'=>$this->setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // if(Gate::denies('create', City::class)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
     //   }

        $regions = Region::orderBy('name')->get();
        return view('cites.create', ['regions'=>$regions, 'setting'=>$this->setting]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // if(Gate::denies('store', City::class)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
      //  }

        if($this->check_double($request)) {
            $city = new City();
            $this->validate($request, $city->rules);
            $city->region_id = $request->region;
            $city->name = $request->name;
            $city->save();

            Session::flash('ok_message', 'Населенный пункт успешно создан.');
        }

        return redirect(route('cites.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return view('cites.show', ['city'=>$city, 'setting'=>$this->setting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city  = City::find($id);

       // if(Gate::denies('create', User::class)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
       // }

        return view('cites.edit', ['city'=>$city, 'setting'=>$this->setting]);
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
        $city = City::find($id);

        //if(Gate::denies('update',$city)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
        //}
        //dd($city);

        $this->validate($request, $city->rules );
        $city->region_id = $request->region;
        $city->name = $request->name;
        $city->save();

        Session::flash('ok_message', 'Населенный пункт успешно изменен.');

        return redirect(route('cites.index'));
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

        $city = City::find($id);
      //  if(Gate::denies('delete', $city)){
       //     return redirect()->back()->with('error_message','Доступ запрещен.');
        //}
        $city->delete();
        return redirect(route('cites.index'))->with('info_message', 'Населенный пункт успешно удален.');;
    }

    public function check_double($request){
        if(City::where(['region_id'=> $request->region,'name'=>$request->name])->exists()){
            Session::flash('error_message', 'Такой населенный пункт уже существует в базе! Попробуйте ввести другое наименование');
            return false;
        }
        return true;
    }
}
