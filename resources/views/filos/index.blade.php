@extends('adminlte::page')
@section('title', 'Gestão de Espécies ')

@section('content_header')
    <h1 class="m-0 text-dark">Filos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('filos.create') }}"> Novo Filo</a>
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
                   @foreach ($filos as $key => $filo)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $filo->nome }}</td>   
                      <td>  
                      <a class="btn btn-xs btn-info" href="{{ route('filos.show',$filo->id) }}">Detalhes</a>  
                         @can('especies-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('filos.edit',$filo->id) }}">Editar</a>
                         @endcan
                         @can('especies-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['filos.destroy', $filo->id],'style'=>'display:inline']) !!}
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
