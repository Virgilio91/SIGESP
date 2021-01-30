@extends('adminlte::page') 
@section('title', 'Editar dados da Espécie')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados da Espécie</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('infraclasses.index') }}"> Voltar</a>
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
                  
                  {!! Form::model($especies , ['method' => 'PATCH','route' => ['especies.update', $especies->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Nome:</strong>
                              {!! Form::text('nome_cientifico', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome Comum:</strong>
                                {!! Form::text('nome_comum', null, array('placeholder' => 'nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Género:</strong>
                                <select name="genero_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>História de Ocorrência:</strong>
                                {!! Form::textarea('historia_ocorrencia', null, array('placeholder' => 'nome','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Nível de conservação:</strong>
                                <select name="nivel__conservacao" class="form-control"> 
                                <option ></option> 
                                    @foreach($nivel__conservacao as $nivel__conservacao)
                                    <option value="{{$nivel__conservacao}}">{{$nivel__conservacao}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Categoria de espécie:</strong>
                                <select name="categoria_especie" class="form-control"> 
                                <option ></option> 
                                    @foreach($categoria_especie as $categoria_especie)
                                    <option value="{{$categoria_especie}}">{{$categoria_especie}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                          <strong>Escolha a Imagem:</strong>
                          <input type="file" name="image" id="image" class="form-control" required >
                          </div>
                      </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Área de Conservação:</strong>
                                <br/>
                                @foreach($acs as $ac)
                                    <label>{{ Form::checkbox('acs[]', $ac->id, false, array('class' => 'name')) }}
                                    {{ $ac->nome }}</label>
                                <br/>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Reprodução:</strong>
                                {!! Form::text('reproducao', null, array('placeholder' => 'Reprodução','class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Alimentação:</strong>
                                {!! Form::textarea('alimentacao', null, array('placeholder' => 'Alimentação','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Vegetação:</strong>
                                {!! Form::text('vegetacao', null, array('placeholder' => 'vegetacao','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Habitat:</strong>
                                {!! Form::text('abrigo', null, array('placeholder' => 'Habitat','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Valor Ecológico:</strong>
                                {!! Form::textarea('valor', null, array('placeholder' => 'Valor Ecológico','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Observações:</strong>
                                {!! Form::textarea('observacoes', null, array('placeholder' => 'Alimentação','class' => 'form-control')) !!}
                            </div>
                        </div>

              
                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                          <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                      </div>
                  </div>
                  
                  {!! Form::close() !!} 

                </div>
            </div>
        </div>
    </div>
@stop