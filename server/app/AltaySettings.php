<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AltaySettings extends Model
{
        protected $fillable = [
        'name',
        'text',
        'heading'
    ];
}
