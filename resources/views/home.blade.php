@extends('layouts.app')

@section('title', 'App Shop Dashboard')

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
        <h2 class="title text-center">Dashboard</h2>
            <!-- Variable flash, si existiera la variable se mostrara y si no, no pasa nada -->
            @if (session('notification'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
            <!-- Sección para mostrar carro de compras y pedidos que se hicieron anteriormente -->
            <ul class="nav nav-pills nav-pills-icons" role="tablist">
                <!--
                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                -->
                <li class="active nav-item">
                    <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
                        <i class="material-icons">dashboard</i>
                        Carrito de compras
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                        <i class="material-icons">list</i>
                        Pedidos realizados
                    </a>
                </li>
            </ul>

            <hr>    
            <p>Tu carrito de compras presenta {{ auth()->user()->cart->details->count() }} productos.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="col-md-2 text-center">Nombre</th>
                        <th class="text-right">Precio</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth()->user()->cart->details as $detail)
                    <tr>
                        <td class="text-center">
                            <!-- a partir de detail vamos a acceder al producto $detail->product mediante la relacion que se plantea en el modelo -->
                            <img src="{{ $detail->product->featured_image_url }}" height="50">
                        </td>
                        <td>
                            <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank">{{ $detail->product->name }}</a>
                        </td>
                        <td class="text-right">$ {{ $detail->product->price }}</td>
                        <td class="text-right">{{ $detail->quantity }}</td>
                        <td class="text-right">$ {{ $detail->quantity * $detail->product->price }}</td>
                        <td class="td-actions text-right">
                            <form method="post" action="{{ url('/cart') }}">
                              @csrf
                              {{ method_field('DELETE') }}
                              <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                              <a href="{{ url('/products/'. $detail->product->id) }}" target="_blank" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-info"></i>
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

            <p><strong>Importe a pagar: </strong> {{ auth()->user()->cart->total }}</p>

            <div class="text-center">
                <form method="post" action="{{ url('/order') }}">
                    @csrf
                    <button class="btn btn-primary btn-round">
                        <i class="material-icons">done</i> Realiza pedido
                    </button>            
                </form>

            </div>
            



      </div>

    </div>
  </div>
  @include('includes.footer')
@endsection




