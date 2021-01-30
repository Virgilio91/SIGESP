@extends('adminlte::page') 
@section('title', 'Criar Áreas de Conservação')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Nova Áreas de Conservação</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('acs.index') }}"> Voltar</a>
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

                    {!! Form::open(array('route' => 'acs.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Provincia:</strong>
                                <select name="provincia_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($provincias as $provincia)
                                    <option value="{{$provincia->id}}">{{$provincia->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Categoria:</strong>
                                <select name="Categoria" class="form-control"> 
                                <option ></option> 
                                    @foreach($categoria as $categoria)
                                    <option value="{{$categoria}}">{{$categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group" >
                            <strong>Tipo:</strong>
                                <select name="Tipo" class="form-control">      
                                    <option ></option>
                                    @foreach($tipo as $tipo)
                                    <option value="{{$tipo}}">{{$tipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-sm btn-success">Registar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop