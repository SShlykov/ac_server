<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "author" => $this->author,
            "text" => $this->text,
            "rating" => $this->rating,
            "driver_id" => $this->driver_id,
        ];
    }
}
