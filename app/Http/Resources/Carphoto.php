<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Carphoto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'car_photo_front' => $this->car_photo_front,
            'car_photo_side'  => $this->car_photo_side,
            'car_photo_back'  => $this->car_photo_back,
            'car_id' => $this->car_id
        ];
    }
}
