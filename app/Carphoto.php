<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carphoto extends Model
{
    protected $fillable = [
        'car_photo_front',
        'car_photo_side',
        'car_photo_back',
        'car_id'
    ];
}
