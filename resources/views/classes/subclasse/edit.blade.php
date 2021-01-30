@extends('adminlte::page') 
@section('title', 'Editar dados do Subclasse')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados do Subclasse</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('subclasses.index') }}"> Voltar</a>
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
                  
                  {!! Form::model($subclasses , ['method' => 'PATCH','route' => ['subclasses.update', $subclasses->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Nome:</strong>
                              {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong>classe:</strong>
                                <select name="classe_id" class="form-control"> 
                                <option ></option> 
                                    @foreach($classes as $classe)
                                    <option value="{{$classe->id}}">{{$classe->nome}}</option>
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