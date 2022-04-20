@extends('layouts.app')

@section('content')

@include('sidebar.beneficiario')

<div class="container">

<form action="{{url('/jornada/asignarNuevoBeneficiario')}}" method="post">
@include('jornada.formBeneficiario',['modo'=>'Crear', $jornada])
@csrf
  

</form>
</div>
@endsection