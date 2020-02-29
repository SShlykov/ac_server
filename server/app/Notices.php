<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
    protected $fillable = [
        'client_name',
        'client_mail',
        'client_phone',
        'client_address',
        'transfer_date',
        'transfer_time',
        'transfer_route',
        'transfer_price',
        'driver_name',
        'driver_id',
    ];
}
