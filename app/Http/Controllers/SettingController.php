<?php

namespace App\Http\Controllers;

use App\Setting;
use Gate;
use Hamcrest\Core\SetTest;
use Illuminate\Http\Request;
use Session;

class SettingController extends Maincontroller
{
    public function edit()
    {

         if(Gate::denies('edit', $this->setting)){
             return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        return view('settings.edit', ['setting'=>$this->setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if(Gate::denies('update', $this->setting)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
         }

        $this->validate($request, $this->setting->rules);

        foreach ($request->request as $key => $value){

            echo $key.' '.$value.'<br>';

            if($key == '_token'){
                continue;
            }
            $this->setting->set_param($key, $value);
        }

        Session::flash('ok_message', 'Параметры успешно изменены.');

        return redirect(route('setting.edit'));
    }
}
