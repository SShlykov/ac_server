<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $fillable = [
        'author',
        'text',
        'rating',
        'driver_id'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
