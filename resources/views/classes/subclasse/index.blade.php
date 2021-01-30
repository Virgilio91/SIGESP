@extends('adminlte::page')
@section('title', 'Gestão de Espécies ')

@section('content_header')
    <h1 class="m-0 text-dark">Subclasses</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('subclasses.create') }}"> Nova Subclasse</a>
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
                   @foreach ($subclasses as $key => $subclasse)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $subclasse->nome }}</td>

                      <td>   
                         @can('especies-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('subclasses.edit',$subclasse->id) }}">Editar</a>
                         @endcan
                         @can('especies-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['subclasses.destroy', $subclasse->id],'style'=>'display:inline']) !!}
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
