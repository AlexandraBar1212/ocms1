<?php
namespace Openlab\Arrivals\Http\Controllers;

use Openlab\Arrivals\Http\Resources\ArrivalResource;
use Openlab\Arrivals\Models\Arrival;
use RainLab\User\Facades\Auth;
use Carbon\Carbon;
use Libuser\Userapi\Models\User;
use Illuminate\Routing\Controller;
use Event;


class ArrivalController extends Controller{
    
    public function arrivals(){
        return ArrivalResource::collection(Arrival::all());
    }
    public function arrival($id) {
        return ArrivalResource::make(Arrival::findOrFail($id));
    }
    public function delete($id){
        $arrival = Arrival::findOrFail($id);
        $arrival->delete();
        return ArrivalResource::make($arrival);
    }
    public function create(){
        $arrival = new Arrival;
        $arrival->firstname = auth()->user()->name;
        $arrival->lastname = auth()->user()->surname;
        $arrival->email = auth()->user()->email;
        $arrival->arrival = Carbon::create(now());
        $arrival->save();

        return ArrivalResource::make($arrival);
    }
    public function myArrivals(){
        Arrival::where('email', auth()->user()->email);
        Event::fire('requestArrivals');
        return ArrivalResource::collection(Arrival::where('email', auth()->user()->email));
        // $arrival->email = auth()->user()->email;
        // $arrival = Arrival::findOrFail('email');

        // $token = request()->bearerToken();
        // return ArrivalResource::make(Arrival::findOrFail($token));
        
   }   
}
