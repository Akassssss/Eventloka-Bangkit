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
        $userId = auth()->user()->id;
        $events = Event::where('public', true)->get();
        $data = $events->filter(function ($event) use ($userId) {
            $organizers = explode(',', $event->organizer);
            return !in_array($userId, $organizers);
        });
        return view('/organizer/index')->with('data',$data);
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
        $organizer = Organizer::whereIn('userId', $organizers)->get();    

        return view('initiator/request')->with('data', $data)->with('organizer', $organizer);
    }
    public function ongoingEventInit(string $id){

        
        $data = Event::where('id', $id)->first();
    

        return view('initiator/ongoing')->with('data', $data);
    }
    
    public function requestEventOrg(string $id){

        $data = Event::where('id', $id)->first();
        $item = Initiator::where('userId', $data->initiator)->first();
        return view('organizer/request')->with('data', $data)->with('item', $item);
    }
    public function updateRequestEventOrg(string $id){
        $upData = [
            'taken'=> true,

        ];
        Event::where('id', $id)->update($upData);

        return redirect('/organizer');
    }
    public function ongoingEventOrg(string $id){

        $data = Event::where('id', $id)->first();    
        return view('organizer/ongoing')->with('data', $data);
    }
    public function doneEventInit(string $id){

        $data = Event::where('id', $id)->first();    
        return view('initiator/done')->with('data', $data);
    }
    public function doneEventOrg(string $id){

        $data = Event::where('id', $id)->first();    
        return view('organizer/done')->with('data', $data);
    }
    public function acceptRequestEvent(Request $request, string $id){

        $data = [
            'organizer' =>$request->organizer,
            'public'=> false,
        ];
        Event::where('id', $id)->update($data);

        return redirect('initiator');

    }
    public function updateOngoingEventInit(Request $request, string $id){
        $data = Event::where('id',$id)->first();
        if($request->input('rate') == $data->rate){
            if($data->doneByOrg == true){
                $upData = [
                    'doneByInit'=> true,
                    'done'=> true,
                    'rateForOrg'=> $request->input('rateForOrg'),
                ];
            } else {
                $upData = [
                    'doneByInit'=> true,
                    'rateForOrg'=> $request->input('rateForOrg'),
                ];
            }
        } else {
            if($data->doneByInit == true){
                $upData = [
                    'doneByInit'=> true,
                    'doneByOrg'=> false,
                    'rateForOrg'=> $request->input('rateForOrg'),
                    'rate'=> $request->input('rate'),
                ];
            } else {
                $upData = [
                    'doneByInit'=> true,
                    'rateForOrg'=> $request->input('rateForOrg'),
                    'rate'=> $request->input('rate')
                ];
            }
        }
        Event::where('id', $id)->update($upData);
        return redirect('initiator/my');
    }
    public function updateOngoingEventOrg(Request $request, string $id){
        $data = Event::where('id',$id)->first();
        if($request->input('rate') == $data->rate){
            if($data->doneByInit == true){
                $upData = [
                    'doneByOrg'=> true,
                    'done'=> true,
                    'rateForInit'=> $request->input('rateForInit'),
                ];
            } else {
                $upData = [
                    'doneByOrg'=> true,
                    'rateForInit'=> $request->input('rateForInit'),
                ];
            }
        } else {
            if($data->doneByInit == true){
                $upData = [
                    'doneByOrg'=> true,
                    'doneByInit'=> false,
                    'rateForInit'=> $request->input('rateForInit'),
                    'rate'=> $request->input('rate'),
                ];
            } else {
                $upData = [
                    'doneByOrg'=> true,
                    'rateForInit'=> $request->input('rateForInit'),
                    'rate'=> $request->input('rate')
                ];
            }
        }
        
        
        Event::where('id', $id)->update($upData);
        return redirect('initiator/my');
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
        $ongoing = Event::where('organizer', auth()->user()->id)->where('done', false)->where('public', false)->where('taken', true)->get();
        $request = Event::where('organizer', auth()->user()->id)->where('done', false)->where('public', false)->where('taken', false)->get();
        $done = Event::where('organizer', auth()->user()->id)->where('done', true)->get();

        return view('organizer/myevent')
        ->with('ongoing',$ongoing)
        ->with('request',$request)
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
            $initiator = Initiator::where('userId', $userId)->first();
        }
        
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
        


        return view('initiator/profile')->with('initiator',$initiator);

    }
    public function profileOrg(){
        $userId = Auth::id();
        $organizer = Organizer::where('userId', $userId)->first();

        if($organizer == null){
            $data = [
                'userId' => $userId,
                'email' => auth()->user()->email
            ];
            Organizer::create($data);
            $organizer = Organizer::where('userId', $userId)->first();
        }
        $hired = Event::where('organizer', $userId)->where('done',true)->count();
        if($hired!=0){
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
                $organizer = Organizer::where('userId', $userId)->first();
            }
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
        $data = [
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'categorySpecialist' => $request->input('categorySpecialist'),
            'scaleSpecialist' => $request->input('scaleSpecialist'),
            'experience' => $request->input('experience'),
            'services' => $request->input('services'),
        ];
        Organizer::where('userId', $userId)->update($data);

        return redirect('organizer/profile');

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
    public function editDetailEvent(string $id){

        $data = Event::where('id', $id)->first();

        return view('initiator/editdetail')->with('data', $data);
    }
    public function updateDetailEvent(Request $request, string $id){

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
            'organizer' => null
        ];
        Event::where('id', $id)->update($data);


        return redirect('/initiator/event/'.$id);
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
                'public' => false,
            ];
            $event = Event::create($data);
            $id = $event->id;
        
        return redirect('/initiator/event/'.$id.'/find');
        } 

        return redirect('/initiator');
    }

    public function findEvent(string $id)
    {
        $data = Event::where('id',$id)->first();
        $organizers = Organizer::where('categorySpecialist', $data->category)
                            ->where('location', 'like', '%'.$data->location.'%')
                            ->get();
        
        return view('/initiator/findeo')->with('organizers',$organizers)->with('data',$data);

    }
    public function pickFindEvent(Request $request, string $id)
    {       
        $data = [
            'organizer' =>$request->input('id'),
        ];
        Event::where('id', $id)->update($data);
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
        $organizer = Organizer::where('userId', auth()->user()->id)->first();
        if (empty($organizer->name)|| empty($organizer->location) || empty($organizer->categorySpecialist) ||empty($organizer->scaleSpecialist) || empty($organizer->experience) ||empty($organizer->services)) {        
            return redirect('organizer/profile')->with('alert', 'Please complete your profile first.');
        }
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
