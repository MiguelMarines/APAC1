@extends('layouts.app')

@section('content')

@include('sidebar.jornada')

<div class="container">
@if (Session::has('eliminado'))
    <div class="alert alert-success" role="alert"> {{Session::get('eliminado')}} </div>      
@endif

@if (Session::has('nuevo'))
    <div class="alert alert-success" role="alert"> {{Session::get('nuevo')}} </div>       
@endif

@if (Session::has('editado'))
    <div class="alert alert-success" role="alert"> {{Session::get('editado')}} </div>    
  
@endif

@if (Session::has('asignado'))
    <div class="alert alert-success" role="alert"> {{Session::get('asignado')}} </div>    
  
@endif

<form action="{{url('/jornada/asignarBeneficiario')}}" method="post">
    @include('jornada.agregarBeneficiario',['modo'=>'Asignar', $jornadaId, $beneficiarios])
    @csrf
</form>
</div>

@endsection