@extends('adminlte::page') 
@section('title', 'Editar dados da Ordem')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados da Ordem</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('ordem.index') }}"> Voltar</a>
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
                  
                  {!! Form::model($ordens , ['method' => 'PATCH','route' => ['ordem.update', $ordens->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Nome:</strong>
                              {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                          </div>
                      </div>
                   
                      <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Classe:</strong>
                                <select name="classe_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($classes as $classe)
                                    <option value="{{$classe->id}}">{{$classe->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>SuperOrdem:</strong>
                                <select name="super_ordem_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($superordens as $superordem)
                                    <option value="{{$superordem->id}}">{{$superordem->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>SuperClasse:</strong>
                                <select name="super_classe_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($superclasses as $superclasse)
                                    <option value="{{$superclasse->id}}">{{$superclasse->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Subclasse:</strong>
                                <select name="sub_classe_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($subclasses as $subclasse)
                                    <option value="{{$subclasse->id}}">{{$subclasse->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Infraclasse:</strong>
                                <select name="infra_classe_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($infraclasses as $infraclasse)
                                    <option value="{{$infraclasse->id}}">{{$infraclasse->nome}}</option>
                                    @endforeach
                                </select>
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