<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'username',
        'password',
        'upassword',
      ];
    Public $timestamps=false;
}
