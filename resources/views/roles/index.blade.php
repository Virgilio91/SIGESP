@extends('adminlte::page') 

@section('title', 'Permissões')

@section('content_header')
    <h1 class="m-0 text-dark">Permissões</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                            @can('role-create')
                                <a class="btn btn-sm btn-success" href="{{ route('roles.create') }}"> Criar Nova Permissão</a>
                            @endcan
                        </div><br>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nome</th>
                            <th width="280px">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('roles.show',$role->id) }}">Detalhes</a>
                                @can('role-edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Eliminar', ['class' => 'btn btn-xs btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                    {{-- {!! $roles->render() !!} --}}


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
