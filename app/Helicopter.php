<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helicopter extends Model
{
    protected $fillable = [
        'name', 'speed', 'color', 'detail','type'
    ];
}
