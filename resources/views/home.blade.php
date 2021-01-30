@extends('adminlte::page')

@section('title', 'SIGESP')

@section('content_header')
{{-- <h1 class="m-0 text-dark">Administração</h1> --}}
       
  <div class="w3-row-padding w3-margin-bottom">
    @can('users-create')
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$users}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4><a href="{{route('users.index')}}">Usuarios</h4></a>
      </div>
    </div>
    @endcan 
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-monument w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$acs}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4><a href="{{route('acs.index')}}">Áreas de Conservação</a></h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-ban w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies_extinta}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Espécies Extintas</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-exclamation-circle w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies_quase}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Espécies Quase Extintas</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-info-circle w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies_via}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Espécies Em Via de Extinção</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-pause-circle w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies_es}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Espécies Estacionárias</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-plus w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies_ab}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Espécies em Abundância</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-green w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-paw w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$especies}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Total de Espécies Registadas</h4>
      </div>
    </div>
  </div>
        

@stop

@section('content')
<div class="container">
    <h4 class="m-0 text-dark mb-3">Vertebrados</h4>
    <div class="w3-row-padding w3-margin-bottom">
    
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-hippo w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$mamiferos}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Mamíferos</h4>
      </div>
    </div>
    
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-dove w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$aves}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4><a href="{{route('acs.index')}}">Aves</a></h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-snake w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{$repteis}}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Repteis</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-otter w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Anfíbios</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-fish w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Peixes</h4>
      </div>
    </div>
    </div>
    
  <!--End Vertebrados-->
  <h4 class="m-0 text-dark mb-3 ">Invertebrados</h4>
  <div class="w3-row-padding w3-margin-bottom">
    
    <div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16">
        <div class="w3-left"><i class="fa fa-spider w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Aracnídeos</h4>
      </div>
    </div>
    
    <div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16">
        <!-- <div class="w3-left"><i class="fa fa-monument w3-xxxlarge"></i></div> -->
        <div class="w3-right">
          <h3>99</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Insectos</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-green w3-padding-16">
        <!-- <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div> -->
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Crustáceos</h4>
      </div>
    </div>
    <div class="w3-quarter mb-3">
      <div class="w3-container w3-green w3-text-white w3-padding-16">
        <!-- <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div> -->
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Moluscos</h4>
      </div>
    </div>
  
   
  </div>

  <!--End Invertebrados-->
</div>
@endsection

@section('css')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection