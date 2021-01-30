@extends('adminlte::page') 
@section('title', 'Editar dados do Usuários')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Dados do Usuário</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-sauccess card-outline">
                <div class="card-body">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-success" href="{{ route('home') }}"> Voltar</a>
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
                  
                  {!! Form::model($user, ['method' => 'PATCH','route' => ['perfil.update', $user->id]]) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Nome:</strong>
                              {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>E-mail:</strong>
                              {!! Form::text('email', null, array('placeholder' => 'E-mail','class' => 'form-control')) !!}
                          </div>
                      </div>
                  
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Senha:</strong>
                              {!! Form::password('password', array('placeholder' => 'Senha','class' => 'form-control')) !!}
                          </div>
                      </div>
                  
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <strong>Confirme a Senha:</strong>
                              {!! Form::password('confirm-password', array('placeholder' => 'Confirme a Senha','class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                          <strong>Escolha a Imagem:</strong>
                              <input type="file" name="image" class="form-control">
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
