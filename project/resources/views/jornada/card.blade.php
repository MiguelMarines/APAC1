
<h1 id="JornadaTitulo" class="bluenefro"><i class="bi bi-calendar3-event"></i> {{$modo}} Jornada</h1>

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


<a href="{{ url('jornada') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Regresar </a>
<br><br>
<div class="card">
  <div class="card-body">
      <br>
      <div class= "row">
          <div class= "col-sm">
                <h2 class="card-title bluenefro">{{ $jornada->nombre }}</h2>
                <br><br>
                <!-- <h3 class="font-weight-light">Estado: {{ $jornada->estado }}</h3> -->
                <h3 class="font-weight-light">Municipio: {{ $jornada->municipio }}</h3>
                <h3 class="font-weight-light">Localidad: {{ $jornada->localidad }}</h3>
                <h3 class="font-weight-light">Fecha: {{ $jornada->fecha }}</h3>
            </div>
            <div class="col-sm">
                <div class= "pt-xl-5">
                    
                </div>
                <!--<div class= "pt-xl-5">
                    <a href="{{url('/jornada/'.$jornada->id.'/anadirBeneficiario')}}">
                    <button type="button" class="btn btn-primary">
                        Añadir beneficiario existente
                    </button>
                    </a>
                </div>-->
                <div class= "pt-xl-2">
                    
                </div>
                <div class= "pt-xl-5">
                    <a href="{{ url('jornada/'.$jornada->id.'/anadirNuevoBeneficiario') }}">
                    @can('social', App\Models\User::class)
                    <button type="button" class="btn btn-success">
                        Añadir nuevo beneficiario
                    </button>
                    @endcan

                    @can('admin', App\Models\User::class)
                    <button type="button" class="btn btn-success">
                        Añadir nuevo beneficiario
                    </button>
                    @endcan

                    @can('procuracion', App\Models\User::class)
                    <button type="button" class="btn btn-success">
                        Añadir nuevo beneficiario
                    </button>
                    @endcan
                    </a>
                </div>
            </div>
        </div>
        <br><br>
  </div>
</div>
<br><br>
<div class="card">
  <div class="card-body">
      <br>
      <div class= "row">
          <div class= "col-sm">
                <div class="col text-center">
                    <h2 class="card-title bluenefro"><i class="bi bi-people"></i> Beneficiarios de la jornada {{ $jornada->nombre }}</h2>
                </div>
                <table class="table table-bordered table-sm table-responsive-sm">
                    <thead class="thead-light text-center">
                    <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Seguimiento</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
    
                    <tbody id="dynamic-row" class="text-center">
                        @foreach ($jornada -> beneficiarios as $beneficiario)
                        <tr>
                            <td>{{$beneficiario->nombreBeneficiario}}</td>
                            

                            <td>{{$beneficiario->age}}</td>
                            
                            <td>{{$beneficiario->sexo}}</td>
                            @if($beneficiario->seguimiento === 1)
                            <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                                </svg> Sí</td>
                            @else
                            <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg> No</td>
                             @endif
                            <td>
                            <a href="{{url('/beneficiario/'.$beneficiario->id)}}" class="btn btn-outline-dark">
                                Consultar
                            </a>
                            <a href="{{url('/beneficiario/'.$beneficiario->id.'/edit')}}" class="btn btn-outline-secondary">
                                Editar
                            </a>
                            <form action="{{url('/beneficiario/'.$beneficiario->id)}}" class="d-inline" method="post">
                            @csrf
                            {{ @method_field('DELETE') }}
                            <input type="submit" onclick="return confirm('¿Quieres borrar este beneficiario?')"  class="btn btn-outline-danger" value="Borrar">
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <br><br>
  </div>
</div>

