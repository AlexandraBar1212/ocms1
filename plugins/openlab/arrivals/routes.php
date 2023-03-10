<?php
    use Openlab\Arrivals\Models\Arrival;
    use Rainlab\User\Facades\Auth;
    use Rainlab\User\Models\User;
    use Openlab\Arrivals\Http\Controllers\ArrivalController;

    // use Autor\Plugin\Models\Model

    Route::group(['prefix' => 'api/v1'], function () {

        Route::get('arrivals', [ArrivalController::class, 'arrivals']);
        Route::get('arrivals/{id}', [ArrivalController::class, 'arrival']);
        Route::delete('arrivals/{id}/delete', [ArrivalController::class, 'delete']);
        
        Route::middleware(['auth'])->group(function(){
            Route::post('arrivals/create', [ArrivalController::class, 'create']);  
            Route::get('arrivals/myArrivals', [ArrivalController::class, 'myArrivals']);  

        });
    });
            