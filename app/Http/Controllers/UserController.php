<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use App\UserProfile;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class UserController extends Controller
{
    public function list(){
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('users.list', ['users'=>$users]);
    }

    public function add(Request $request){

        $user = new User();

        if(Gate::denies('add', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $user = new User();

        if($request->isMethod('post')){

           $this->validate($request, [
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:6|confirmed',
               'full_name' => 'required|string',
               'phone' => 'required|string|numeric',
           ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            $profile = new UserProfile();
            $profile->name = $request->full_name;
            $profile->phone = $request->phone;
            $profile->firm_id = $request->firm;
            $profile->branch_id = 0;
            $profile->status = $request->status;

            $user->profile()->save($profile);

            $user->roles()->attach($request->role);

            Session::flash('ok_message', 'User created.');

            return redirect(route('users'));
        }

        return view('users.add', ['user'=>$user]);

    }

    public function edit(Request $request, $id){

        $user = User::find($id);

        if(Gate::denies('edit', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        if($request->isMethod('post')){

            $this->validate($request, [
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
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile->name = $request->full_name;
            $user->profile->phone = $request->phone;
            $user->profile->firm_id = $request->firm;
           // $user->profile->branch_id = $request->branch;
            $user->profile->status = $request->status;
            $user->profile->save();
            $user->save();

            //$user->roles()->detach();
            //$user->roles()->attach($request->role);
            $user->roles()->sync($request->role);

            Session::flash('ok_message', 'User updated.');

            return redirect(route('users'));
        }

        return view('users.edit', ['user'=>$user]);
    }

    public function del($id){

        $user = User::find($id);

        if(Gate::denies('del', $user)){
            return redirect()->back()->with('error_message','Доступ запрещен.');
        }

        $user->delete();
        $user->roles()->detach();
        $user->profile()->delete();
        return redirect(route('users'));
    }

    public function branch_list(Request $request){
        $id = $request->id;
        $htm = '';
        $branches = Client::where('firm_id', $id)->get();
        $htm .= '<option value="0">-</option>';
        foreach ($branches as $branch){
            $htm .= '<option value="'.$branch->id.'">'.$branch->name.'</option>';
        }
        return $htm;
    }
}
