<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class UserController extends Controller
{
    public function list(){
        $users = User::orderBy('created_at', 'desc')->paginate(2);
        return view('users.list', ['users'=>$users]);
    }

    public function add(Request $request){

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
        $user->delete();
        $user->roles()->detach();
        $user->profile()->delete();
        return redirect(route('users'));
    }
}
