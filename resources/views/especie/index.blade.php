@extends('adminlte::page') 
@section('title', 'gestão de Espécies')

@section('content_header')
    <h1 class="m-0 text-dark">Espécie</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('especies.create') }}"> Nova Espécie </a>
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
                     <th>Nome Científico</th>
                     <th>Nome Comum</th>
                     <th width="280px">Ação</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($especies as $key => $especie)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $especie->nome_cientifico }}</td>
                        <td>{{$especie->nome_comum}}
                      <td>
                         <a class="btn btn-xs btn-info" href="{{ route('especies.show',$especie->id) }}">Detalhes</a>
                         @can('especies-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('especies.edit',$especie->id) }}">Editar</a>
                         @endcan
                         @can('especies-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['especies.destroy', $especie->id],'style'=>'display:inline']) !!}
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

