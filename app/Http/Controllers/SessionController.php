<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index(){
        return view('landing');
    }
    
    public function indexRegister(){
        return view('register');
    }
    public function storeRegister(Request $request)
    {
        $data = [
            'name' => $request->input('username'),
            'password' =>Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'email' => $request->input('email')
        ];
        User::create($data);
        

        return redirect('login');
    }
    public function indexLogin(){
        return view('login');
    }

    public function processLogin(Request $request){
        Session::flash('email', $request-> email);

        $infoLogin= [
            'email' => $request ->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infoLogin)){
            if (Auth::user()->role == 'initiator'){
                return redirect('/initiator');
            } else {
                return redirect('/organizer');
            }
        } else {
            return redirect('/login');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
