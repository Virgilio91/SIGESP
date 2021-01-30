@extends('adminlte::page')
@section('title', 'Gestão de Espécies ')

@section('content_header')
    <h1 class="m-0 text-dark">Infraordems</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('infraordens.create') }}"> Nova Infraordem</a>
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
                   @foreach ($infraordem as $key => $infraordem)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $infraordem->nome }}</td>

                      <td>   
                         @can('especies-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('infraordens.edit',$infraordem->id) }}">Editar</a>
                         @endcan
                         @can('especies-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['infraordens.destroy', $infraordem->id],'style'=>'display:inline']) !!}
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
