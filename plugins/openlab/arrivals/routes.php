<?php
    use Openlab\Arrivals\Models\Arrival;
    use Carbon\Carbon;
    use Rainlab\User\Facades\Auth;
    use Rainlab\User\Models\User;

    // use Autor\Plugin\Models\Model

    Route::group(['prefix' => 'api/v1'], function () {
        Route::get('arrivals', function () {
            $arrivals = Arrival::all();
            return $arrivals;
        });
        Route::get('arrivals/{id}', function ($id) {
            $arrival = Arrival::find($id);
            return $arrival;
        });
        Route::delete('arrivals/{id}/delete', function ($id) {
            $arrival = Arrival::find($id);
            $arrival->delete();
            return $arrival;
        }); 
        Route::middleware(['auth'])->group(function(){
            Route::post('arrivals/create', function () {
    
    
                $arrival = new Arrival;
                $arrival->firstname = auth()->user()->name;
                $arrival->lastname = auth()->user()->surname;
                $arrival->arrival = Carbon::create(now());
                $arrival->save();
        
                Event::fire('arrival.created', $arrival);
        
                return $arrival;
            });  
            Route::post('arrivals/update/{id}', function ($id) {
       
                $arrival = Arrival::where('id', $id)
                ->firstOrFail();
                $arrival->firstname = auth()->user()->name;
                $arrival->lastname = auth()->user()->surname;
                $arrival->arrival = Carbon::create(now());
                $arrival->save();
        
                Event::fire('arrival.created', $arrival);
        
                return $arrival;
            }); 
        });
    });

