<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cows extends Model
{
    protected $fillable = [
        'name',
        'breed',
        'age'
    ];
}
