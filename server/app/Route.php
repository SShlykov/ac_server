<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
    'name',
    'latitude',
    'longitude'
];
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
    public function route_groups()
    {
        return $this->belongsToMany('App\RouteGroup');
    }
}
