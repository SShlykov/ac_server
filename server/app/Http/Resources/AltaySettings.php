<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AltaySettings extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "text" => $this->text,
            "heading"=>$this->heading
        ];
    }
}
