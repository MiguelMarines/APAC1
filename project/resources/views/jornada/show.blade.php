@extends('layouts.app')

@section('content')

@include('sidebar.jornada')

<div class="container">
    @csrf
    {{ method_field('PATCH') }}
    @include('jornada.card',['modo'=>'Detalle de'])

</div>

@endsection