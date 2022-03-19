<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
  
  protected $fillable = [
    'hotel_title',
    'hotel_image',
    'hotel_description',
    'product_category',
    'product_author',
    'tags',
  ];
  Public $timestamps=false;
}
