@extends('layouts.app')

@section('title', 'App | Dashboard')

@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!-- header con una imagen de fondo -->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
  </div>
  
  <!-- Carta con propaganda de aplicacion -->
  <div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="profile">
              <div class="avatar">
              <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
              </div>
            </div>
          </div>
        </div>
        
        @if (session('notification'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('notification') }}
            </div>
        @endif
        <div class="description text-center">
          <h3 class="title">{{ $product->name }}</h3>
          <h6>{{ $product->category->name }}</h6>
        </div>
        <div class="description text-center">
            <p>{{ $product->long_description }}</p>
        </div>

        <!-- Button trigger modal -->
        <div class="text-center">
          <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddToCart">
            <i class="material-icons">add</i>Añadir al carrito de compras
          </button>
        </div>

        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="profile-tabs">
              <div class="nav-align-center">
                <div class="tab-content gallery">
                  <div class="tab-pane active" id="studio">
                    <div class="row"> 
                      <div class="col-md-6">
                        @foreach ($imagesLeft as $image)
                          <img src="{{ $image->url }}" alt="img-rounded">
                        @endforeach
                      </div>
                      <div class="col-md-6">
                        @foreach ($imagesRight as $image)
                          <img src="{{ $image->url }}" alt="img-rounded">
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Profile Tabs -->
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione la cantidad que desea agregar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="post" action="{{ url('/cart')}}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="modal-body">
                  <input type="number" name="quantity" value="1" class="form-control">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
  @include('includes.footer')
@endsection
