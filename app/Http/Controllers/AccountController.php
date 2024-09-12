<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function register(Request $request){
        return view('account.register');
    }

    public function registerProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:18|confirmed',
            'password_confirmation' => 'required|min:6|max:18'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'You have been registered successfully!');

        return response()->json([
            'status' => true,
            'errors' => null,
        ]);

    }

    public function login(Request $request){
        return view('account.login');
    }

    public function loginProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:18'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $user = User::Where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'status' => false,
                'errors' => ['email' => 'The email you entered is not valid.'],
            ]);
        }

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => false,
                'errors' => ['password' => 'The password you entered is incorrect.'],
            ]);
        }

        Auth::login($user);
        session()->flash('success', 'You have been logged in successfully!');

        return response()->json([
            'status' => true,
            'errors' => null,
        ]);
    }

    public function logout(){
        if(!Auth::check()){
            session()->flash('success', 'You are not logged in to your account!');

            return redirect()->route('account.login');
        }

        Auth::logout();

        session()->flash('success', 'You have been logged out successfully!');

        return redirect()->route('account.login');

    }

    public function profile(){
        return view('account.profile');
    }
}
