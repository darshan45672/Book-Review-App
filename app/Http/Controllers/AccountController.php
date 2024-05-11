<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function showRegister(){
        return view('account.register');
    }

    public function userRegister( Request $request ){
        $validator = Validator::make($request->all(), [
            'name' => 'required | min:3',
            'email' => 'required|email',
            'password' => 'required| confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            # code...
            return redirect()->route('account.showRegister')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.showLogin')->with('success', 'User registered successfully');
    }

    public function showLogin(){
        return view('account.login');
    }
}
