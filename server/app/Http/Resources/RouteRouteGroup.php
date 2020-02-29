<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RouteRouteGroup extends JsonResource
{
    public function toArray($request)
    {
        return [
            'route_group_id' => $this->route_group_id,
            'route_id' => $this->route_id
        ];
    }
}
