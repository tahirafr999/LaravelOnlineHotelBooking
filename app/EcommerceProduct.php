<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcommerceProduct extends Model
{
    protected $fillable = [
        'title',
        'photo',
        'product_description',
        'category',
        'author',
        'tags',
        'product_price',
      ];
}
