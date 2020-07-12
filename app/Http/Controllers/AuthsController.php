<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthsController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('user_id', 'password') )) {
            return redirect('/admin');
        }else{
            return redirect('/login');
        }
    }

    public function daftar()
    {
        $stamp = date("Yms");
        $data['id'] = str_shuffle($stamp);
        return view('auth.daftar', $data);
    }

    public function signup(Request $request)
    {
        if($request->confirm == $request->pass){
            $data = [
                'name' => $request->nama,
                'user_id' => $request->user,
                'password' => password_hash($request->pass, PASSWORD_DEFAULT),
                'role' => 'user'
            ];
            DB::table('users')->insert($data);
            return redirect('/login');
        }else{
            return redirect('/daftar');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
