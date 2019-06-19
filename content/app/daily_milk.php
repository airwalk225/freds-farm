<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daily_milk extends Model
{
    protected $fillable = [
        'cow_id',
        'milk_volume',
        'milked_datetime'
    ];
}
