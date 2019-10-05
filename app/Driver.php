<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
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
}
