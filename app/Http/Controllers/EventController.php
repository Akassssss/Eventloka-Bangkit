<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function indexInit(){
        
        $data = Event::where('initiator', auth()->user()->id)->get();
        return view('/initiator/index')->with('data', $data);
    }
    public function indexOrg(){
        return view('/organizer/index');
    }
    public function indexCreateEvent(){
        return view('initiator/create');
    }
    public function detailEvent(string $id){

        $data = Event::where('id', $id)->first();

        if ($data->initiator != auth()->user()->id){
            return redirect('initiator');
        }
        if ($data->organizer === null || $data->organizer === '') {
            $organizers = [];
        } else {
            // Memecah string organizer menjadi array
            $organizers = explode(',', $data->organizer);
        }        $sum = count($organizers);

        return view('initiator/detail')->with('data', $data)->with('sum', $sum);
    }

    public function storeEvent(Request $request){
        $type = $request->input('action');
        
        if ($type == 'post') {
            $request->validate([
                'name' => 'required|string',
                'date' => 'required|date',
                'location' => 'required|string',
                'scale' => 'required|integer',
                'description' => 'required|string',
                'category' => 'required|string',
                'theme' => 'required|string',
                'budget' => 'required|string',
                'price' => 'required|string',
            ]);
            $data = [
                'name'=>$request->input('name'),
                'date' =>$request->input( 'date'),
                'location' =>$request->input( 'location'),
                'scale' =>$request->input( 'scale'),
                'description' =>$request->input( 'description'),
                'category' =>$request->input( 'category'),
                'theme' =>$request->input( 'theme'),
                'budget' =>$request->input( 'budget'),
                'price' =>$request->input( 'price'),
                'initiator' => Auth::user()->id,
                'app' => false,
                'public' => true,
            ];
            Event::create($data);
            return redirect('/initiator');
        } elseif ($type == 'search') {
            // Handle the form submission for searching organizers
        } 

        return redirect('/initiator');
    }

    public function indexAvailableOrg(){
        $userId = auth()->user()->id;
        $events = Event::all();
        $data = $events->filter(function ($event) use ($userId) {
            $organizers = explode(',', $event->organizer);
            return !in_array($userId, $organizers);
        });
        return view('/organizer/available')->with('data',$data);
    }
    public function detailAvailableOrg(string $id){
        $data = Event::where('id', $id)->first();
        return view('/organizer/detail')->with('data',$data);
    }
    public function takeEvent(string $id){

        $data = Event::where('id', $id)->first();
        if($data->organizer != null){
            $organizer = $data->organizer;
            $organizer = $organizer . ',' . auth()->user()->id;
        } else {
            $organizer = auth()->user()->id;
        }
        $data = [
            'organizer' =>$organizer,
        ];
        Event::where('id', $id)->update($data);

        return redirect('/organizer/available');
        
        // return view('/organizer/detail')->with('data',$data);
    }
    public function indexEventOrg(){
        return view('/organizer/event');
    }
}
