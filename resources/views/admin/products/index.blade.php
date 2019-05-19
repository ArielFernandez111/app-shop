@extends('layouts.app')

@section('title', 'Listado de productos')

@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!-- header con una imagen de fondo -->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">

  </div>
  
  <!-- Carta con propaganda de aplicacion -->
  <div class="main main-raised">
    <div class="container">

      <!-- Seccion donde se muestran los productos -->
      <div class="section text-center">
        <h2 class="title">Listado de productos</h2>
        <div class="team">
          <div class="row">
            <!-- Boton de crear nuevos productos -->
            <div class="col-md-12">
                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round">Nuevo producto</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="col-md-2 text-center">Nombre</th>
                        <th class="col-md-5 text-center">Descripción</th>
                        <th class="text-center">Categoría</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="col-md-4">{{ $product->description }}</td>
                        <!-- <td>{{ $product->category ? $product->category->name : 'General'}}</td> -->
                        <td>{{ $product->category->name }}</td>
                        <td class="text-right">&euro; {{ $product->price }}</td>
                        <td class="td-actions text-right">
                            <form method="post" action="{{ url('/admin/products/'. $product->id) }}">
                              @csrf
                              {{ method_field('DELETE') }}
                              <a href="{{ url('/products/' . $product->id) }}" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-fab btn-fab-mini" target="_blank">
                                  <i class="fa fa-info"></i>
                              </a>
                              <a href="{{ url('/admin/products/'. $product->id .'/edit') }}" rel="tooltip" title="Editar Producto" class="btn btn-success btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-edit"></i>
                              </a>
                              <a href="{{ url('/admin/products/'. $product->id .'/images') }}" rel="tooltip" title="Imagenes del producto" class="btn btn-warning btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-image"></i>
                              </a>
                              <button rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-times"></i>
                              </button>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Codigo para el paginado -->
            {{ $products->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>

  @include('includes.footer')
@endsection
