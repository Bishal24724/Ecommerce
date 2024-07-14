<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    public $timestamps=false;
    

  
    public function sizes()
{
    return $this->hasMany(ProductSize::class);
}


public function brand()
    {
        return $this->belongsTo(Brand::class,'bid');
    }

 public function category()
    {
        return $this->belongsTo(Category::class,'cid');
    }

public function type()
    {
        return $this->belongsTo(Type::class,'tid');
    }

   
  
  
}

