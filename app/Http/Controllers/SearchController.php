<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function show(Request $request){
        $query = $request->input('query');
        //dd($query);
        //estamos buscando productos cuyo nombre sea exactamente lo que hemos escrito($query)
        $products = Product::where('name', 'like', "%$query%")->paginate(6);

        if($products->count() == 1) {
            $id = $products->first()->id;
            return redirect("products/$id");    //equivalente a 'products/'.$id
        }

        return view('search.show')->with(compact('products', 'query'));
    }

    public function data(){
        $products = Product::pluck('name');
        return $products;
    }
}
