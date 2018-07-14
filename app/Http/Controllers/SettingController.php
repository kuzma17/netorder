<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Session;

class SettingController extends Controller
{
    public function edit(Setting $setting)
    {

        /// if(Gate::denies('edit', $cartridge)){
        //     return redirect()->back()->with('error_message','Доступ запрещен.');
        //}

        return view('settings.edit', ['setting'=>$setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        //if(Gate::denies('update', $cartridge)){
        //    return redirect()->back()->with('error_message','Доступ запрещен.');
        // }

        $this->validate($request, $setting->rules);

        foreach ($request->request as $key => $value){
            if($key == '_token'){
                continue;
            }
            $setting->set_setting($key, $value);
        }

        Session::flash('ok_message', 'Параметрыуспешно изменен.');

        return view('settings.edit', ['setting'=>$setting]);
    }
}
