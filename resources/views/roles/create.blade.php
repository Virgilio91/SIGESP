@extends('adminlte::page') 

@section('title', 'nova permissão')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Novo Nível de Acesso</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-success btn-sm" href="{{ route('roles.index') }}"> Voltar</a>
                    </div><br>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Preencha todos os campos correctamente.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permissão:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}



                </div>
            </div>
        </div>
    </div>
@stop
