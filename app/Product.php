<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //$product->category
    public function category(){
        //un producto($this) pertenece(belongsTo) a una categoria(Category)
        return $this->belongsTo(Category::class);
    }
    //$product->images
    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    //accessor
    public function getFeaturedImageUrlAttribute(){
        $featuredImage = $this->images()->where('featured', true)->first();
        if(!$featuredImage){
            $featuredImage = $this->images()->first();
        }
        if($featuredImage){
            return $featuredImage->url;
        }
        //default
        return '/images/products/default.jpg';
    }

    //accesor
    public function getCategoryNameAttribute(){
        //si la categoría del producto existe
        if($this->category)
            //devolveremos el nombre de la categoría
            return $this->category->name;
        //caso contrario devolveremos general
        return 'General';
    }
}
