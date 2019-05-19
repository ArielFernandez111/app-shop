<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    // un detalle pertenece a un producto  
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
