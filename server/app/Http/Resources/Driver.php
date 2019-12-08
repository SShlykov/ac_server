<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Driver extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "last_name" => $this->last_name,
            "phone" => $this->phone,
            "locale" => $this->locale,
            "photo" => $this->photo
        ];
    }
}
