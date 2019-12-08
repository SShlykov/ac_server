<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'type',
        'sits',
        'fuel',
        'price',
        'child'
    ];
    public function carphoto()
    {
        return $this->hasOne(Carphoto::class);
    }
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
