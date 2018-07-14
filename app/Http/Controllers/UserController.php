<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contractor;
use App\Firm;
use App\Role;
use App\User;
use App\UserProfile;
use DemeterChain\Main;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class UserController extends Maincontroller
{
    public function list(){
        $users = User::orderBy('created_at', 'desc')->paginate($this->setting->get('paginate'));
        return view('users.list', ['users'=>$users, 'setting'=>$this->setting]);
    }

    public function view($id){
        $user = User::find($id);
        return view('users.view', ['user'=>$user, 'setting'=>$this->setting]);
    }

    public function add(Request $request){

        $user = new User();

        if(Gate::denies('add', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $user = new User();

        if($request->isMethod('post')){

           $rules = [
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:6|confirmed',
               'full_name' => 'required|string',
               'phone' => 'required|string|numeric',
               'role' => 'required'
           ];

            if($request->role != 1){
                $rules['firm'] = 'required|not_in:0';
            }

            $this->validate($request, $rules);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            $profile = new UserProfile();
            $profile->name = $request->full_name;
            $profile->phone = $request->phone;
            $profile->role_id = $request->role;
            if($request->role == 1){
                $profile->firm_id = 0;
                $profile->branch_id = 0;
                $profile->contractor_id = 0;
            }elseif($request->role == 2){
                $profile->firm_id = $request->firm;
                $profile->branch_id = 0;
                $profile->contractor_id = 0;
            }elseif($request->role == 3){
                $profile->firm_id = $request->firm;
                $profile->branch_id = $request->branch;
                $profile->contractor_id = 0;
            }elseif($request->role == 4){
                $profile->firm_id = 0;
                $profile->branch_id = 0;
                $profile->contractor_id = $request->firm;
            }

            //$profile->firm_id = isset($request->firm)?$request->firm:0;
            //$profile->branch_id = isset($request->branch)?$request->branch:0;
          //  $profile->contractor_id = isset($request->contractor)?$request->contractor:0;
            $profile->status = $request->status;


            $user->profile()->save($profile);

            Session::flash('ok_message', 'Пользователь успешно создан.');

            return redirect(route('users'));
        }

        $roles = Role::all();
        $firms = Firm::where('status', 'on')->orderBy('name')->get();

        return view('users.add', ['user'=>$user, 'roles'=>$roles, 'firms'=>$firms, 'setting'=>$this->setting]);

    }

    public function edit(Request $request, $id){

        $user = User::find($id);

        if(Gate::denies('edit', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){
            $rules = [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'full_name' => 'required|string',
                'phone' => 'required|string|numeric',
                'role' => 'required',
                ];

            if($request->role != 1){
                $rules['firm'] = 'required|not_in:0';
            }

            $this->validate($request, $rules);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile->name = $request->full_name;
            $user->profile->role_id = $request->role;
            $user->profile->phone = $request->phone;

            if($request->role == 1){
                $user->profile->firm_id = 0;
                $user->profile->branch_id = 0;
                $user->profile->contractor_id = 0;
            }elseif($request->role == 2){
                $user->profile->firm_id = $request->firm;
                $user->profile->branch_id = 0;
                $user->profile->contractor_id = 0;
            }elseif($request->role == 3){
                $user->profile->firm_id = $request->firm;
                $user->profile->branch_id = $request->branch;
                $user->profile->contractor_id = 0;
            }elseif($request->role == 4){
                $user->profile->firm_id = 0;
                $user->profile->branch_id = 0;
                $user->profile->contractor_id = $request->firm;
            }

            //$user->profile->firm_id = isset($request->firm)?$request->firm:0; // фирма клиент/подрядчик
            //$user->profile->branch_id = isset($request->branch)?$request->branch:0;
            //$user->profile->contarctor_id = isset($request->contarctor)?$request->contarctor:0;
            $user->profile->status = $request->status;
            $user->profile->save();
            $user->save();

            Session::flash('ok_message', 'Пользователь изменен.');

            return redirect(route('users'));
        }

        $roles = Role::all();
        $firms = [];
        $branches = [];
        if($user->is_client()) {
            $firms = Firm::where('status', 'on')->orderBy('name')->get();
            $branches = Client::where('firm_id', $user->profile->firm_id)->where('status', 'on')->orderBy('name')->get();
        }
        if($user->is_admin_firm()) {
            $firms = Firm::where('status', 'on')->orderBy('name')->get();
            $branches = [];
        }
        if($user->is_contractor()) {
            $firms = Contractor::where('status', 'on')->orderBy('name')->get();
            $branches = [];
        }

        return view('users.edit', ['user'=>$user, 'roles'=>$roles, 'firms'=>$firms, 'branches'=>$branches, 'setting'=>$this->setting]);
    }

    public function edit_passwd(Request $request, $id){
        $user = User::find($id);

        if(Gate::denies('edit', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')) {

            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            Session::flash('ok_message', 'Пароль успешно изменен.');
            return $this->view($id);
        }

        return view('users.edit_passwd', ['user'=>$user, 'setting'=>$this->setting]);
    }

    public function del($id){

        $user = User::find($id);

        if(Gate::denies('del', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $user->delete();
        $user->profile()->delete();
        return redirect(route('users'))->with('info_message', 'Пользователь успешно удален.');;
    }

}
