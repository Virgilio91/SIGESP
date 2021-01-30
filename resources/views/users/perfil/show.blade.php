@extends('adminlte::page') 
@section('title', 'Detalhes do Usuários')

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes do Usuário</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                                <a class="btn btn-sm btn-success" href="{{ route('home') }}"> Voltar</a>
                            </div><br>

                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome:</strong>
                                        
           
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>E-mail:</strong>
                                        
                                    </div>
                                </div>
                            
                               
                            </div>

                </div>
            </div>
        </div>
    </div>
@stop
    