<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Initiator;
use App\Models\Organizer;
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
                $userId = Auth::id();
                $initiator = Initiator::where('userId', $userId)->first();
                $hired = Event::where('initiator', $userId)->where('done',true)->count();
                if($hired != 0){
                    $eventRate = Event::where('initiator', $userId)->where('done',true)->sum('rate');
                    $eventRated = round($eventRate / $hired, 2); 
                    $rate = Event::where('initiator', $userId)->where('done',true)->sum('rateForInit');
                    $rated = round($rate / $hired, 2); 
                    if($initiator->hired != $hired OR $initiator->eventRate != $eventRated OR $initiator->rate != $rated){
                        $data = [
                            'eventRate'=> $eventRated,
                            'rate'=> $rated,
                            'hired'=> $hired,
                        ];
                        Initiator::where('userId', $userId)->update($data);
                        $initiator = Initiator::where('userId', $userId)->first();
                    }
                }
                return redirect('/initiator');
            } else {
                $userId = Auth::id();
                $organizer = Organizer::where('userId', $userId)->first();
                $hired = Event::where('organizer', $userId)->where('done',true)->count();
                if($hired != 0){
                    $eventRate = Event::where('organizer', $userId)->where('done',true)->sum('rate');
                    $eventRated = round($eventRate / $hired, 2); 
                    $rate = Event::where('organizer', $userId)->where('done',true)->sum('rateForOrg');
                    $rated = round($rate / $hired, 2); 

                    if($organizer->hired != $hired OR $organizer->eventRate != $eventRated OR $organizer->rate != $rated){
                        $data = [
                            'eventRate'=> $eventRated,
                            'rate'=> $rated,
                            'hired'=> $hired,
                        ];
                        Organizer::where('userId', $userId)->update($data);
                    }
                }
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
