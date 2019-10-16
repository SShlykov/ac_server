<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteGroup extends Model
{
    protected $fillable = [
        'name'
    ];
    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
