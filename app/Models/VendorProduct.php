<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'price', 'quantity', 'picture', 'description', 'category'
    ];

    public $timestamps=false;
   
    
}
