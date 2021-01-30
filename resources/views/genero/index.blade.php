@extends('adminlte::page')
@section('title', 'Gestão de Espécies ')

@section('content_header')
    <h1 class="m-0 text-dark">Género</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('genero.create') }}"> Nova Género </a>
                      @endcan
                  </div><br>
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif
                  
                  <table class="table table-bordered" id="data-table" >
                   <thead>
                   <tr>
                     <th>No</th>
                     <th>Nome</th>
                     
                     <th width="280px">Ação</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($generos as $key => $genero)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $genero->nome }}</td>
                      
                        
                      
                      <td>     
                      <a class="btn btn-xs btn-info" href="{{ route('genero.show',$genero->id) }}">Detalhes</a>
                         @can('especies-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('genero.edit',$genero->id) }}">Editar</a>
                         @endcan
                         @can('especies-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['genero.destroy', $genero->id],'style'=>'display:inline']) !!}
                              {!! Form::submit('Eliminar', ['class' => 'btn btn-xs btn-danger']) !!}
                          {!! Form::close() !!}
                          @endcan
                      </td>
                    </tr>
                   @endforeach
                   </tbody>
                  </table>
                  
                 {{--  {!! $data->render() !!} --}}


                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('#data-table').dataTable();
        });
    </script>
@stop
