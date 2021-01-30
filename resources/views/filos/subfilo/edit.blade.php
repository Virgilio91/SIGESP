@extends('adminlte::page') 
@section('title', 'Editar dados do Subfilo')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados do Subfilo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('subfilos.index') }}"> Voltar</a>
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
                  
                  {!! Form::model($subfilos , ['method' => 'PATCH','route' => ['subfilos.update', $subfilos->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Nome:</strong>
                              {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Filo:</strong>
                                <select name="filo_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($filos as $filo)
                                    <option value="{{$filo->id}}">{{$filo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Grupo:</strong>
                                <select name="grupo" class="form-control"> 
                                <option ></option> 
                                    @foreach($grupo as $grupo)
                                    <option value="{{$grupo}}">{{$grupo}}</option>
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