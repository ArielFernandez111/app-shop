<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id){
        //Encontraremos al producto con marcado en la vista enviado mediante el id
        $product = Product::find($id);
        //de forma especifica obtendremos las imagenes de ese producto
        //$images = $product->images;
        $images = $product->images()->orderBy('featured', 'desc')->get();   //ordene en base al campo featured de forma descendente y que finalice la consulta haciendo uso del metodo get
        //para que luego esa informacion la enviemos a la vista
        return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    //como nos interesa capturar la imagen que se esta subiendo, y la imagen es un campo que forma parte de la solicitud vamos a hacer uso de la clase Request
    public function store(Request $request, $id){
        // 1ro vamos a guardar la img en nuestro proyecto, es decir, el archivo
        $file = $request->file('photo');    //obtiene el archivo que se esta subiendo, enviando a traves de un campo con name photo y lo guarda en una variable file
        $path = public_path() . '/images/products';
        $fileName = uniqid() . $file->getClientOriginalName();
        $moved = $file->move($path, $fileName);
        // 2do vamos a crear un registro en la BBDD especificamente dentro de la tabla product_images
        if ($moved){
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage->featured = false;
            $productImage->product_id = $id;
            $productImage->save();  //INSERT
        }

        return back();
    }

    public function destroy(Request $request, $id){
        // eliminar el archivo
        $productImage = ProductImage::find($request->image_id);    // $request->input('image_id') es equivalente a $request->image_id
        if(substr($productImage->image, 0, 4) === "http"){
            $deleted = true;
        } else {
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            $deleted = File::delete($fullPath);
        }

        // eliminar el registro de la img en la BBDD
        if($deleted){
            $productImage->delete();
        }

        return back();
    }

    public function select($id, $image){
        //desmarcamos otras imagenes que esten como destacadas de este producto
        //Todas las imagenes de producto que esten asociadas con el producto que tiene este id, se van a actualizar en base a los siguientes campos 
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);
        //destacamos imagen
        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();
        
        return back();
    }
}
