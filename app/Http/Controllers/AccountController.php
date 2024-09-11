<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function register(Request $request){
        return view('account.register');
    }

    public function login(Request $request){
        return view('account.login');
    }
}
