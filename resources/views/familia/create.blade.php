@extends('adminlte::page') 
@section('title', 'Criar Família')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Nova Família</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('familia.index') }}"> Voltar</a>
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

                    {!! Form::open(array('route' => 'familia.store','method'=>'POST')) !!}
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                {!! Form::text('nome', null, array('placeholder' => 'nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Ordem:</strong>
                                <select name="ordem_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($ordens as $ordem)
                                    <option value="{{$ordem->id}}">{{$ordem->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>SuperOrdem:</strong>
                                <select name="super_ordem_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($superordens as $superordem)
                                    <option value="{{$superordem->id}}">{{$superordem->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>InfraOrdem:</strong>
                                <select name="infra_ordem_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($infraordens as $infraordem)
                                    <option value="{{$infraordem->id}}">{{$infraordem->nome}}</option>
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
