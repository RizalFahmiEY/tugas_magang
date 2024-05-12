<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sesicontroller extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ],
        [
            'email.required'=>'email harus diisi',
            'password.required'=>'password harus diisi',
        ]
        );


        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,

        ];

        if(Auth::attempt($infologin)){

            if(Auth::user()->role == 'operator'){
                return redirect('admin/operator');
            }
            elseif(Auth::user()->role == 'keuangan'){
                return redirect('admin/keuangan');
            }
            elseif(Auth::user()->role == 'marketing'){
                return redirect('admin/marketing');
            }
            
        }else{
            return redirect('')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }

    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
