<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $fillable = ['hotel_name','surname','email','phone','total_price','notes'];
    Public $timestamps=false;
}
