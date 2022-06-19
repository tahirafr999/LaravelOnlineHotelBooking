<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class excel extends Model
{
    protected $fillable = [
        'category', 'series' ,
    ];

    Public $timestamps=false;

}
