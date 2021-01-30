@extends('adminlte::page') 
@section('title', 'Editar dados da Classe')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados da Classe</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('classes.index') }}"> Voltar</a>
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
                  
                  {!! Form::model($classes , ['method' => 'PATCH','route' => ['classes.update', $classes->id]]) !!}
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
                                <select name="filo_id" class="form-control" onchange="show_subfilo"> 
                                <option ></option> 
                                    @foreach($filos as $filo)
                                    <option value="{{$filo->id}}">{{$filo->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>Subfilo:</strong>
                                <select name="sub_filo_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($subfilos as $subfilo)
                                    <option value="{{$subfilo->id}}">{{$subfilo->nome}}</option>
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