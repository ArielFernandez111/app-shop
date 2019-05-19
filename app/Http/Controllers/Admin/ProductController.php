<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index(){
        //$products = Product::all();
        $products = Product::paginate(10);
        //devuelve esta lista con estos resultados
        return view('admin.products.index')->with(compact('products'));    //listado
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories'));   //formulario de registro
    }

    public function store(Request $request){
        //validar
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es un campo obligatorio.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $messages);

        //registrar nuevo producto en la BBDD
        //dd($request->all());  este metodo all nos devuelve todos los campos
        //crearemos un producto nuevo
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
        $product->save();   //INSERT EN TABLA PRODUCTOS
        return redirect('/admin/products');
    }

    public function edit($id){
        //return "Mostrar aqui el formulario de edición para el producto con id $id";
        $categories = Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product', 'categories'));   //formulario de edición
    }

    public function update(Request $request, $id){
        //validar
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción corta es un campo obligatorio.',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres.',
            'price.required' => 'Es obligatorio definir un precio para el producto.',
            'price.numeric' => 'Ingrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $messages);

        //registrar cambios de producto en la BBDD
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
        $product->save();   //UPDATE EN TABLA PRODUCTOS
        return redirect('/admin/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();  //DELETE
        //redirigimos al usuario a la pagina anterior(productos)
        return back();
    }
}
