<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessibleRouteGroup extends Model
{
    protected $fillable = [
        'name'
    ];
    public function mainRoute()
    {
        return $this->hasOne(Route::class);
    }
    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
