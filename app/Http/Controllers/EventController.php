<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Initiator;
use App\Models\Organizer;
use App\Models\User;
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
    public function requestEvent(string $id){

        
        $data = Event::where('id', $id)->first();

        if ($data->organizer === null || $data->organizer === '') {
            $organizers = [];
        } else {
            // Memecah string organizer menjadi array
            $organizers = explode(',', $data->organizer);
        }
        $eo = User::whereIn('id', $organizers)->get();    


        return view('initiator/request')->with('eo',$eo)->with('data', $data);
    }
    public function acceptRequestEvent(Request $request, string $id){

        $data = [
            'organizer' =>$request->organizer,
            'public'=> false,
        ];
        Event::where('id', $id)->update($data);

        return redirect('initiator');

    }

    public function myEventInit(){
        $waiting = Event::where('initiator', auth()->user()->id)->where('public', true)
        ->where('organizer', null)->get();
        $reaching = Event::where('initiator', auth()->user()->id)->where('public', false)
        ->where('organizer', null)->get();
        $response = Event::where('initiator', auth()->user()->id)->where('public', true)
        ->whereNotNull('organizer')->get();
        $ongoing = Event::where('initiator', auth()->user()->id)->where('public', false)
        ->where('done', false)->whereNotNull('organizer')->get();
        $done = Event::where('initiator', auth()->user()->id)->where('done', true)->get();

        return view('initiator/myevent')
        ->with('waiting',$waiting)
        ->with('reaching',$reaching)
        ->with('response',$response)
        ->with('ongoing',$ongoing)
        ->with('done',$done);
    }
    public function myEventOrg(){
        // $waiting = Event::where('initiator', auth()->user()->id)->where('public', true)
        // ->where('organizer', null)->get();
        // $reaching = Event::where('initiator', auth()->user()->id)->where('public', false)
        // ->where('organizer', null)->get();
        // $response = Event::where('initiator', auth()->user()->id)->where('public', true)
        // ->whereNotNull('organizer')->get();
        $ongoing = Event::where('organizer', auth()->user()->id)->where('done', false)->where('public', false)->get();
        $done = Event::where('organizer', auth()->user()->id)->where('done', true)->get();

        return view('organizer/myevent')
        // ->with('waiting',$waiting)
        // ->with('reaching',$reaching)
        // ->with('response',$response)
        ->with('ongoing',$ongoing)
        ->with('done',$done);

    }
    public function profileInit(){
        $userId = Auth::id();
        $initiator = Initiator::where('userId', $userId)->first();

        if($initiator == null){
            $data = [
                'userId' => Auth::id(),
                'name' => auth()->user()->name,
                'rate'=> 0,
                'hired'=> 0,
                'location'=> '',
                'about'=> '',
            ];
            Initiator::create($data);
        }
        return view('initiator/profile')->with('initiator',$initiator);

    }
    public function profileOrg(){
        $userId = Auth::id();
        $organizer = Organizer::where('userId', $userId)->first();

        if($organizer == null){
            $data = [
                'userId' => $userId,
            ];
            Organizer::create($data);
        }
        return view('organizer/profile')->with('organizer',$organizer);

    }
    public function editProfileOrg(){
        $userId = Auth::id();
        $organizer = Organizer::where('userId', $userId)->first();

        return view('organizer/editprofile')->with('organizer',$organizer);

    }
    public function updateProfileOrg(Request $request){
        $userId = Auth::id();
        $organizer = Organizer::where('userId', $userId)->first();
        $data = [
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'categorySpecialist' => $request->input('categorySpecialist'),
            'scaleSpecialist' => $request->input('scaleSpecialist'),
            'experience' => $request->input('experience'),
            'services' => $request->input('services'),
        ];
        Organizer::where('userId', $userId)->update($data);

        return view('organizer/editprofile')->with('organizer',$organizer);

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
        }        
        $sum = count($organizers);

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
        $events = Event::where('public', true)->get();
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
