@extends('adminlte::page') 
@section('title', 'gestão de Espécies')

@section('content_header')
    <h1 class="m-0 text-dark">Espécie</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                  
                  <div class="pull-right">
                      @can('especies-create')
                      <a class="btn btn-sm btn-success" href="{{ route('especies.create') }}"> Nova Espécie </a>
                      @endcan
                  </div><br>
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif
                  
                
                  <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>   
                    <tr>  
                        <th>No</th>     
                        <th>Nome Científico</th>    
                        <th>Nome Comum</th> 
                        <th width="280px">Ação</th>
                            
                    </tr>    
                </thead>     
            </table>
                  
                 {{--  {!! $data->render() !!} --}}


                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@rtop
@section('js')
    <script>
     $(document).ready( function () {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!!  route('especies.index') !!}',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'nome_cientifico', name: 'nome_cientifico'},
                    { data: 'nome_comum', name: 'nome_comum'},
                  
                ]
            });
        } );
    </script>
@stop

