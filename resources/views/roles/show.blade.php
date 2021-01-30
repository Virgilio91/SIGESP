@extends('adminlte::page') 

@section('title', 'Permissões')

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes do Nível de Acesso</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                            <a class="btn btn-success btn-sm" href="{{ route('roles.index') }}"> Voltar</a>
                        </div><br>
                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome:</strong>
                                        {{ $role->name }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Permissões:</strong>
                                        @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                                <label class="label label-success">{{ $v->name }},</label>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>


                </div>
            </div>
        </div>
    </div>
@stop