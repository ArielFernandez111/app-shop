<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name')->paginate(10);
        //devuelve esta lista con estos resultados
        return view('admin.categories.index')->with(compact('categories'));    //listado
    }

    public function create(){
        return view('admin.categories.create');   //formulario de registro
    }

    public function store(Request $request){
        //validar desde modelo Category
        $this->validate($request, Category::$rules, Category::$messages);

        //registrar la nueva categoría en la BBDD
        Category::create($request->all());  //mass assignment
        //request all nos traera todos los campos que el formulario envia, a la par tenemos que trabajar con el modelo Category

        return redirect('/admin/categories');
    }

    public function edit(Category $category){
        return view('admin.categories.edit')->with(compact('category'));   //formulario de edición
    }

    public function update(Request $request, Category $category){
        //validar desde modelo Category
        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->all());
        return redirect('/admin/categories');
    }

    public function destroy(Category $category){
        $category->delete();  //DELETE
        return back();
    }
}
