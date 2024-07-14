<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;
    protected $fillable = ['id','cId','longitude','latitude','oId'];
    public $timestamps= false;

    public function order(){
        return $this->belongsTo(Order::class);
    }


}
