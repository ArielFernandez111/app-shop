@extends('layouts.app')

@section('title', 'Listado de categorias')

@section('body-class', 'profile-page sidebar-collapse')

@section('content')
  <!-- header con una imagen de fondo -->
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">

  </div>
  
  <!-- Carta con propaganda de aplicacion -->
  <div class="main main-raised">
    <div class="container">

      <!-- Seccion donde se muestran los categorias -->
      <div class="section text-center">
        <h2 class="title">Listado de categorias</h2>
        <div class="team">
          <div class="row">
            <!-- Boton de crear nuevos categorias -->
            <div class="col-md-12">
                <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-round">Nueva categoria</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <!--
                        <th class="text-center">#</th>
                        -->
                        <th class="col-md-2 text-center">Nombre</th>
                        <th class="col-md-5 text-center">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                    <tr>
                         <!-- Asignar un numero que se incremente de acuerdo a la cantidad de categorías que tengamos 
                        <td class="text-center">{{ ($key+1) }}</td>
                        -->
                        <td>{{ $category->name }}</td>
                        <td class="col-md-4">{{ $category->description }}</td>
                        <td class="td-actions text-right">
                            <form method="post" action="{{ url('/admin/categories/'. $category->id) }}">
                              @csrf
                              {{ method_field('DELETE') }}
                              <a href="#" rel="tooltip" title="Ver Categoria" class="btn btn-info btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-info"></i>
                              </a>
                              <a href="{{ url('/admin/categories/'. $category->id .'/edit') }}" rel="tooltip" title="Editar Categoria" class="btn btn-success btn-simple btn-fab btn-fab-mini">
                                  <i class="fa fa-edit"></i>
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
            {{ $categories->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>

  @include('includes.footer')
@endsection
