<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rewiew extends Model
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
