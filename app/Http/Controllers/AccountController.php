<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AccountController extends Controller
{
    public function showRegister()
    {
        return view('account.register');
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | min:3',
            'email' => 'required|email | unique:users',
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

    public function showLogin()
    {
        return view('account.login');
    }

    public function userAuthenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'password' => 'required | min:8'
        ]);

        if ($validator->fails()) {
            # code...
            return redirect()->route('account.showLogin')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.showProfile')->with('success','Logged In successfully');
        } else {
            return redirect()->route('account.showLogin')->with('error', 'Either email/password is incorrect');
        }
    }

    public function showProfile()
    {
        $user = User::find(Auth::user()->id);
        // dd($user);

        return view('account.profile', [
            'user' => $user,
        ]);
    }

    public function userProfileUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required | email |unique:users,email,' . Auth::user()->id . ',id',
        ];
        // dd($request->image);

        if (!empty($request->image)) {
            # code...
            $rules['image'] = 'mimes:jpeg,jpg,png,gif|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);
        // dd($validator);

        if ($validator->fails()) {
            # code...
            return redirect()->route('account.showProfile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if (!empty($request->image)) {

            File::delete(public_path('userUploads/profilePicture/'.$user->image));

            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;

            $image->move(public_path('userUploads/profilePicture'), $imageName);
            $user->image = $imageName;
            $user->save();

            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('userUploads/profilePicture/'.$imageName));
            $img->cover(150, 150);
            // dd($img);
            $img->save(public_path('userUploads/profilePicture/'.$imageName));
        }

        return redirect()->route('account.showProfile')->with('success', 'Profile updated successfully');
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('account.showLogin')->with('success', "Logged Out Sucessfully!");
    }
}
