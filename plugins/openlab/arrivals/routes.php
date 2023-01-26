<?php
    use Openlab\Arrivals\Models\Arrival;
    use Carbon\Carbon;
    use Rainlab\User\Facades\Auth;
    use Rainlab\User\Models\User;
    // use Autor\Plugin\Models\Model

    Route::get('api/arrivals', function () {
        $arrivals = Arrival::all();
        return $arrivals;
    });
    Route::get('api/arrivals/{id}', function ($id) {
        $arrival = Arrival::find($id);
        return $arrival;
    });
    Route::delete('api/arrivals/{id}/delete', function ($id) {
        $arrival = Arrival::find($id);
        $arrival->delete();
        return $arrival;
    }); 
    Route::middleware(['auth'])->group(function(){
        Route::post('api/arrivals/create', function () {


            $arrival = new Arrival;
            $arrival->firstname = auth()->user()->name;
            $arrival->lastname = auth()->user()->surname;
            $arrival->arrival = Carbon::create(now());
            $arrival->save();
    
            Event::fire('arrival.created', $arrival);
    
            return $arrival;
        });  
    });
