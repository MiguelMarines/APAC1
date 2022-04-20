<h1 id="JornadaTitulo" class="bluenefro"><i class="bi bi-person-plus-fill"></i> {{$modo}} Beneficiario</h1>

@if (count($errors)>0)
    
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
           <li> {{$error}} </li>
        @endforeach 
        </ul>
    </div>
    
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

@if ($modo == "Crear")
    <a href="{{ url('jornada/'.$jornada->id) }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Regresar</a>
@else
    <a href="{{ url('beneficiario') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Regresar </a>
@endif
<br><br>

<div class="form-group">

<label for="nombreBeneficiario">Nombre</label>
<input type="text" class="form-control" name="nombreBeneficiario" value="{{isset($beneficiario) ? $beneficiario->nombreBeneficiario: ''}}" id="nombreBeneficiario">

</div>

<div class="form-group">

<label for="jornada_id">Jornada</label>
    <select name="jornada_id" id="jornada_id" class="custom-select">
    @if ($modo == "Editar")
        {{-- Checa si se paso un beneficiario como argumento y si 
        este beneficiario tiene una entrada en la tabla pivote beneficiario_jornada --}}
        <option value="{{isset($beneficiario) && $beneficiario->jornadas->isEmpty() == false ? $beneficiario->jornadas[0]->pivot->jornada_id: ''}}" selected>{{$beneficiario->jornadas->isEmpty() ? "Selecciona una jornada" : $beneficiario->getJornadaName()}}</option>
    @elseif ($modo == "Crear")
        <option value="{{isset($jornada) ? $jornada->id: ''}}" selected>{{isset($jornada) ? $jornada->nombre: 'Selecciona su jornada'}}</option>
    @endif
</select>

</div>

<div class="form-group">
    <label for="fechaNacimiento">Fecha de nacimiento</label>
    <input class="date form-control" type="date" name="fechaNacimiento" value="{{isset($beneficiario) ? $beneficiario->fechaNacimiento: ''}}" id="fechaNacimiento">    
</div>

<!--

    //Eliminado a petición del cliente
<div class="form-group">
<label for="direccion">Dirección</label>
<input type="text" class="form-control" name="direccion" value="{{isset($beneficiario) ? $beneficiario->direccion: ''}}" id="direccion">

</div>
-->

<div class="form-group">
<label for="telefono">Número de telefono</label>
<input type="text" class="form-control" name="telefono" maxlength="10" value="{{isset($beneficiario) ? $beneficiario->telefono: ''}}" id="telefono">

</div>

<div class="form-group">
    <label for="sexo">Sexo</label>
    <select name="sexo" class="custom-select" id="sexo">
        @if($modo == 'Editar')
            <option value="{{isset($beneficiario) ? $beneficiario->sexo: ''}}" selected>{{$beneficiario->sexo}}</option>
        @endif
        <option value="Hombre">Hombre</option>
        <option value="Mujer">Mujer</option>
    </select>
</div>

<div class="form-group">
    <label for="escolaridade_id">Escolaridad</label>
    <select name="escolaridade_id" class="custom-select" id="escolaridade_id">
        @if($modo == 'Editar')
            <option value="{{isset($beneficiario) ? $beneficiario->escolaridade_id: ''}}" selected>{{$beneficiario->escolaridade->nombreEscolaridad}}</option>
        @endif
        <option value="2">Primaria</option>
        <option value="3">Secundaria</option>
        <option value="4">Preparatoria</option>
        <option value="5">Universidad</option>
        <option value="6">Maestría</option>
        <option value="1">Analfabeta</option>
    </select>
</div>

<!-- Atributo solicitado en inicio, ahora obsoleto.
<div class="form-group">
    <label for="estatus">Estatus</label>
    <select name="estatus" class="custom-select" id="estatus">
        @if($modo == 'Editar')
            <option value="{{isset($beneficiario) ? $beneficiario->estatus: ''}}" selected>{{$beneficiario->estatus}}</option>
        @endif
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
</div>
-->

<div class="form-group">
    <label for="seguimiento">De seguimiento</label>
    <select name="seguimiento" class="custom-select" id="seguimiento">
        @if($modo == 'Editar')
            @if ($beneficiario->seguimiento == 1)
                <option value="{{isset($beneficiario) ? $beneficiario->seguimiento: ''}}" selected>Sí</option>
            @else
                <option value="{{isset($beneficiario) ? $beneficiario->seguimiento: ''}}" selected>No</option>
            @endif
        @endif
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select>
</div>


<div class="form-group">
    <label for="estatus">Descendencia Africana</label>
    <select name="descAfricana" class="custom-select" id="descAfricana">
        @if($modo == 'Editar')
            @if ($beneficiario->descAfricana == 1)
                <option value="1" selected>Sí</option>
            @else
                <option value="0" selected>No</option>
            @endif
        @endif
        <option value="0">No</option>
        <option value="1">Sí</option>
    </select>
</div>

<!--
    //Aun no estamos seguro que tipo de información es estatus

<div class="m-3">
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    De seguimiento
  </label>
</div>
</div>
-->

<div class="col text-center">
    <button class="btn btn-success btn-lg" type="submit"><i class="bi bi-pencil-square"></i> {{$modo}}</button>
</div>

{{-- <script type="text/javascript">
    $('.date').datepicker({  
       format: 'yyyy-mm-dd'
     });  
</script>  --}}