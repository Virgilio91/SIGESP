@extends('adminlte::page') 
@section('title', 'Detalhes da Área de conservação ')

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes da Área de conservação </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                                <a class="btn btn-sm btn-success" href="{{ route('acs.index') }}"> Voltar</a>
                            </div><br>

                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome:</strong>
                                        {{ $acs->nome }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Provincia:</strong>
                                        {{ $provincia->nome }}   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Categoria:</strong>
                                        {{ $acs->Categoria }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Tipo:</strong>
                                        {{ $acs->Tipo }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Área de cobertura:</strong>
                                        {{ $acs->area_cobertura }}
                                    </div>
                                </div>
                                
                            
                                
                            </div>

                </div>
            </div>
        </div>
    </div>
@stop
    