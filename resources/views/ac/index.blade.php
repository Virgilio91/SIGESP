@extends('adminlte::page') 
@section('title', 'gestão das Áreas de Conservação ')

@section('content_header')
<h1 class="m-0 text-dark">Áreas de Conservação</h1>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('ac-create')
                      <a class="btn btn-sm btn-success" href="{{ route('acs.create') }}"> Nova Áreas de Conservação</a>
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
                     <th>Categoria</th>
                     <th>Tipo</th>
                     <th width="280px">Ação</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach ($acs as $key => $ac)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $ac->nome}}</td>
                      <td>{{ $ac->Categoria}}</td>
                      <td>{{$ac->Tipo}}</td>
                      <td>
                         <a class="btn btn-xs btn-info" href="{{ route('acs.show',$ac->id) }}">Detalhes</a>
                         @can('ac-edit')
                         <a class="btn btn-xs btn-primary" href="{{ route('acs.edit',$ac->id) }}">Editar</a>
                         @endcan
                         @can('ac-delete') 
                         {!! Form::open(['method' => 'DELETE','route' => ['acs.destroy', $ac->id],'style'=>'display:inline']) !!}
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
