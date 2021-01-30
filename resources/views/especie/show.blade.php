@extends('adminlte::page') 
@section('title', 'Detalhes da Espécies')

@section('content_header')
    <h1 class="m-0 text-dark">Detalhes da Espécies </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                        <div class="pull-right">
                                <a class="btn btn-sm btn-success" href="{{ route('especies.index') }}"> Voltar</a>
                            </div><br>


                        <div class="row">

                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <img src="{{url('storage/especies/'.$especies->image)}}" class="img-fluid" alt="{{$especies->nome_comum}}" style="max-width: 100%;height: auto">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome Comum:</strong>
                                        {{$especies->nome_comum}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nome Científico:</strong>
                                        {{$especies->nome_cientifico}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>História de Ocorrência:</strong>
                                        {{$especies->historia_ocorrencia}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Nível de Conservação:</strong>
                                        {{$especies->nivel__conservacao}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Categoria de Espécie:</strong>
                                        {{$especies->categoria_especie}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Áreas de Conservação:</strong>
                                        @foreach($acs as $key => $ac)
                                       <hr> {{$ac->nome}}<hr>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Reprodução:</strong>
                                        @foreach($conds as $key => $cond)
                                        {{$cond->reproducao}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Alimentação:</strong>
                                        @foreach($conds as $key => $cond)
                                        {{$cond->alimentacao}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Vegetação:</strong>
                                        @foreach($conds as $key => $cond)
                                        {{$cond->vegetacao}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Habitat:</strong>
                                        @foreach($conds as $key => $cond)
                                        {{$cond->abrigo}}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Valor Ecológico:</strong>
                                        @foreach($valor as $key => $valor)
                                        {{$valor->valor}}
                                        @endforeach
                                    </div>
                                </div>
                              
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Género:</strong>
                                        {{ $genero->nome}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Familia:</strong>
                                        {{ $familia->nome}}
                                    </div>
                                </div>
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Ordem:</strong>
                                        {{ $ordens->nome}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Superordem:</strong>
                                        {{ $superordem->nome}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Classe:</strong>
                                        {{ $classes->nome }}
                                    </div>
                                </div>
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Subclasse:</strong>
                                        {{ $subclasse->nome }}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Infraclasse:</strong>
                                        {{ $infraclasse->nome }}
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
                                        {{ $subfilo->nome }}   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Reino:</strong>
                                        {{ $reinos->nome }}   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Observações:</strong>
                                        @foreach($conds as $key => $cond)
                                        {{$cond->observacoes}}
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>

                </div>
            </div>
        </div>
    </div>
@stop