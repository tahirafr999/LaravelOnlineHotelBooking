<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     Public $timestamps=false;
    protected $fillable = ['product_name'];
    public static function getAddCartItems( ) {
    
        return "Hello World!";
      
      }
}
