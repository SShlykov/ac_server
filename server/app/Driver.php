<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{

    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'locale',
        'photo'
    ];
    public function car()
    {
        return $this->hasOne(Car::class);
    }
    public function rewiew()
    {
        return $this->hasMany(Review::class);
    }
    public function route()
    {
        return $this->hasOne(Route::class);
    }

    public function route_group()
    {
        return $this->belongsToMany('\App\RouteGroup');
    }
}
