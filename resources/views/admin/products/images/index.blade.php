@extends('layouts.app')

@section('title', 'Imagenes de productos')

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
        <h2 class="title">Imagenes de producto "{{ $product->name }}"</h2>
        
        <!-- cuando el action esta vacio la peticion se hara sobre una ruta con el mismo nombre, equivalente a que se haga una peticion a si mismo -->
        <form method="post" action="" enctype="multipart/form-data">
          @csrf
          <input type="file" name="photo" required>
          <button type="submit" class="btn btn-primary btn-round">Subir nueva imagen</button>
          <a href="{{ url('/admin/products') }}" class="btn btn-default btn-round">Volver a listado de productos</a>
        </form>

        <hr>

        <div class="row">
          @foreach ($images as $image)
            <div class="col-md-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <img src="{{ $image->url }}" width="250" height="250">
                  <form method="post" action="">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                    <button type="submit" class="btn btn-danger btn-round">Eliminar imagen</button>
                    @if ($image->featured)
                      <button type="button" class="btn btn-info btn-round" rel="tooltip" title="Imagen destacada actualmente">
                        <i class="material-icons">favorite</i>
                      </button>
                    @else
                      <a href="{{ url('/admin/products/'. $product->id .'/images/select/'. $image->id) }}" class="btn btn-primary btn-fab btn-fab-mini btn-round">
                        <i class="material-icons">favorite</i>
                      </a>
                    @endif
                    
                  </form>
                  
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>

    </div>
  </div>

  @include('includes.footer')
@endsection
