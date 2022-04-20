
<h1 id="JornadaTitulo" class="bluenefro"><i class="bi bi-calendar3-event"></i> {{$modo}} Jornada</h1>
<a href="{{ url('jornada') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Regresar </a>
<br><br>

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

<div class="form-group">

<label for="nombre">Nombre</label>
<input type="text" class="form-control" name="nombre" value="{{ isset($jornada->nombre)?$jornada->nombre:old('nombre') }}" id="nombre">

</div>

<div class="form-group">
    <div class="row">
      <div class="col 1">
       
          <label for="Fecha">Fecha</label>
          <input class="date form-control" type="date" name="fecha" value="{{ isset($jornada->fecha)?$jornada->fecha:old('fecha') }}" id="fecha">    
      </div>
    </div>
</div>

{{-- <div class="form-group">
    <label for="Fecha">Fecha</label>
    <input class="date form-control" type="date" name="fecha" value="{{ isset($jornada->fecha)?$jornada->fecha:old('fecha') }}" id="fecha">    
</div> --}}

<div class="form-group">
    <label for="localidad">Localidad</label>
    <input type="text"class="form-control" name="localidad" value="{{ isset($jornada->localidad)?$jornada->localidad:old('localidad') }}" id="localidad">
</div>

<div class="form-group">
<label for="Municipio">Municipio</label>
<input type="text" class="form-control" name="municipio" value="{{ isset($jornada->municipio)?$jornada->municipio:old('municipio') }}" id="municipio">

</div>

<div class="col text-center">
    <button class="btn btn-success" type="submit"><i class="bi bi-pencil-square"></i> {{$modo}}</button>
</div>


{{-- <script type="text/javascript">
    $('.date').datepicker({  
       format: 'yyyy-mm-dd'
     });  
</script>  --}}