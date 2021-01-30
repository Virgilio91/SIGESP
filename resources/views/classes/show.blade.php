@extends('adminlte::page') 
@section('title', 'Detalhes da Classe ')

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes da Classe </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                                <a class="btn btn-sm btn-success" href="{{ route('classes.index') }}"> Voltar</a>
                            </div><br>

                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome:</strong>
                                        {{ $classes->nome }}
                                    </div>
                                </div>
                               
                               
                            
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Filo:</strong>
                                        {{ $filos->nome }}   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Subfilo:</strong>
                                        {{ $subfilos->nome }}   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Reino:</strong>
                                        {{ $reinos->nome }}   
                                    </div>
                                </div>
                                
                            </div>

                </div>
            </div>
        </div>
    </div>
@stop
    