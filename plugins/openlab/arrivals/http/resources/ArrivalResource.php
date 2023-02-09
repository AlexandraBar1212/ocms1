<?php
namespace Openlab\Arrivals\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArrivalResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'name' => $this->firstname,
            'surname' => $this->lastname,
            'arrival' => $this->arrival,
            'email' => $this->email,
        ];
    }
    
}