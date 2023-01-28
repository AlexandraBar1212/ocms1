<?php
namespace Openlab\Arrivals\Http\Controllers;

use Openlab\Arrivals\Http\Resources\ArrivalResource;
use Openlab\Arrivals\Models\Arrival;
use RainLab\User\Facades\Auth;
use Carbon\Carbon;
use Libuser\Userapi\Models\User;
use Illuminate\Routing\Controller;
use Event;


class ArrivalController{
    
    public function arrivals(){
        return ArrivalResource::collection(Arrival::all());
    }
    public function arrival($id){
        return ArrivalResource::colection(Arrival::find($id));
    }
    public function delete($id){
        $arrival = Arrival::find($id);
        $arrival->delete();
        return ArrivalResource::colection(Arrival::find($id));
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
   
    // public function update() {


    //     $arrival = Arrival::where('id', $arrival_id)
    //     ->firstOrFail();
    //     $arrival->firstname = auth()->user()->name;
    //     $arrival->lastname = auth()->user()->surname;
    //     $arrival->arrival = Carbon::create(now());
    //     $arrival->save();

    //     Event::fire('arrivals.created', $arrival);

    //     return ArrivalResource::collection(Arrival::where('user_id', auth()->user()->id)->get());
    // }
}