<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'image',
        'time',
        'text'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function routes()
    {
        return $this->belongsToMany(Route::class);
    }
}
