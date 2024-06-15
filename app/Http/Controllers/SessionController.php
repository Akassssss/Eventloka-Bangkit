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
    public function indexInit(){
        return view('/initiator/index');
    }
    public function indexOrg(){
        return view('/organizer/index');
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
                return redirect('/initiator/index');
            } else {
                return redirect('/organizer/index');
            }
        } else {
            return redirect('/');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
