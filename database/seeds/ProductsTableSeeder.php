<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dos opciones make (crea objetos) y create(crea el objeto y lo guarda en la BBDD)
        
        /* Reparte de manera aleatoria los registros
        factory(Category::class, 5)->create();
        factory(Product::class, 100)->create();
        factory(ProductImage::class, 200)->create();
        */

        //distribuiremos registros de acuerdo a lo que nosotros queremos donde sera 5 categorias en las cuales tendremos 20 productos por categoria y por cada producto que tenga 5 imagenes del producto
        $categories = factory(Category::class, 5)->create();
        $categories->each(function ($category) {
            $products = factory(Product::class, 20)->make();
            $category->products()->saveMany($products);

            $products->each(function ($p) {
                $images = factory(ProductImage::class, 5)->make();
                $p->images()->saveMany($images);
            });
        });
    }
}
