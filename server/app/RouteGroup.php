<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteGroup extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    public function routes()
    {
        return $this->belongsToMany('App\Route');
    }

    public function drivers()
    {
        return $this->belongsToMany('\App\Driver');
    }
}
