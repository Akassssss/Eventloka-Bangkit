<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function indexCreateEvent(){
        return view('initiator/create');
    }
}
