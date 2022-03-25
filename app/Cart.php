<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public static function getAddCartItems($par1,$par2){
        $para1 = 5; $para2 = 10;

        $para3 = $para1 + $para2;
        return $para3;
        
    }
}
