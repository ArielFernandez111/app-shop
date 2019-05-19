@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')

@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!-- header con una imagen de fondo -->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
  </div>
  
  <!-- Carta con propaganda de aplicacion -->
  <div class="main main-raised">
    <div class="container">

      <!-- Seccion donde se muestran los productos -->
      <div class="section">
        <h2 class="title text-center">Registrar nuevo producto</h2>
          <form method="post" action="{{ url('/admin/products') }}">
            @csrf

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group label-floating">
                  <label class="control-label">Nombre del producto</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group label-floating">
                  <label class="control-label">Precio del producto</label>
                  <input type="number" class="form-control" name="price">
                </div>
              </div>            
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group label-floating">
                <label class="control-label">Descripción corta</label>
                <input type="text" class="form-control" name="description">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group label-floating">
                  <label class="control-label">Categoría del producto</label>
                  <select class="form-control" name="category_id">
                    <option value="0">General</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>            
            </div>


            
            <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description"></textarea>

            <button class="btn btn-primary">Registrar producto</button>

          </form>
      </div>

    </div>
  </div>
  @include('includes.footer')
@endsection