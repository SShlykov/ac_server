<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Car extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "type" => $this->type,
            "sits" => $this->sits,
            "fuel" => $this->fuel,
            "price" => $this->price,
            "child" => $this->child,
            "driver_id" => $this->driver_id
        ];
    }
}
