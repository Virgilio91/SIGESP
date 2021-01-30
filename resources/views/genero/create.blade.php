@extends('adminlte::page') 
@section('title', 'Criar Género  ')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Novo Género </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('genero.index') }}"> Voltar</a>
                    </div> <br>

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

                    {!! Form::open(array('route' => 'genero.store','method'=>'POST')) !!}
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                {!! Form::text('nome', null, array('placeholder' => 'nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Família:</strong>
                                <select name="familia_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($familias as $familia)
                                    <option value="{{$familia->id}}">{{$familia->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
