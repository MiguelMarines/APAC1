@extends('layouts.app')

@section('content')

@include('sidebar.jornada')

<div class="container">
<form action="{{url('/jornada/'.$jornada->id)}}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('jornada.form',['modo'=>'Editar'])
</form>
</div>
@endsection