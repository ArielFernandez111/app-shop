@extends('layouts.app')

@section('title', 'Resultados de busqueda')

@section('body-class', 'profile-page sidebar-collapse')

@section('styles')
<style>
  .team{
    padding-bottom: 50px;
  }
</style>
@endsection

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
              <img src="{{ asset('img/search.png') }}" alt="Imagen de la lupa que representa los resultados" class="img-raised rounded-circle img-fluid">
              </div>
            </div>
          </div>
        </div>

        <div class="description text-center">
          <h3 class="title">Resultados de busqueda</h3>
        </div>

        @if (session('notification'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('notification') }}
            </div>
        @endif

        <div class="description text-center">
            <p>Se encontraron {{ $products->count() }} resultados para el termino {{ $query }}.</p>
        </div>

        <div class="team text-center">
          <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
              <div class="team-player">
                <div class="card card-plain">
                  <div class="col-md-6 ml-auto mr-auto">
                    <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                  </div>
                  <h4 class="card-title">
                    <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                  </h4>
                  <div class="card-body">
                    <p class="card-description">{{ $product->description }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="text-center">
            {{ $products->links() }}
          </div>
        </div>
        <!-- Button trigger modal -->

      </div>
    </div>
  </div>

  @include('includes.footer')
@endsection
