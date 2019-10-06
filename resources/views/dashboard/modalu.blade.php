@extends('dashboard.dashboard')
@section('titulo')
	Modificacion de alumno
@endsection

@section('menus')
                <ul class="nav">
                    <li>
                        <a href="{{URL::action('calif@indexdir')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">content_paste</i>
                            <p>Profesores</p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{URL::action('calif@buscaprof')}}">
                                    <!--<i class="material-icons">person</i> -->
                                    <p>Buscar Profesor</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::action('calif@altaprof')}}">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                    <p>Alta de Profesores</p>
                                </a>
                            </li>
                            <!--<li>
                                <a href="#">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                   <!-- <p>Baja Profesores</p>
                                </a> 
                            </li> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">content_paste</i>
                            <p>Alumnos</p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{URL::action('calif@altaalumno')}}">
                                    <!--<i class="material-icons">person</i> -->
                                    <p>Alta Alumnos</p>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                   <!-- <p>Buscar Alumno</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                    <!-- <p>Baja Alumno</p>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">content_paste</i>
                            <p>Grupos</p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{URL::action('calif@gengrupo')}}">
                                    <!--<i class="material-icons">person</i> -->
                                    <p>Generar grupo</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::action('calif@admingrupo')}}">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                    <p>Administrar grupos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">content_paste</i>
                            <p>Fechas Evaluaciones</p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{URL::action('calif@evregular')}}">
                                    <!--<i class="material-icons">person</i> -->
                                    <p>Evaluacion Regular</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::action('calif@evextra')}}">
                                    <!-- <i class="material-icons">content_paste</i> -->
                                    <p>Evaluacion Extraordinaria</p>
                                </a>
                            </li>
                        </ul>
                    </li> 
                </ul>
@endsection


@section('titulopage')
	Modifica Alumno
@endsection

@section('Contenido')
    @if (Session::has('msage'))
            <script>
                alert("{{Session::get('msage')}}");
            </script>
    @endif
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Modifica Alumno</h4>
                                    <p class="category">Verifica los datos</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="card-content">
                                            <form action="{{route('gmalumno')}}" method="POST">
                                                {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                                <div class="row">
                                                    <div class="col-md-5">
                                                            <input type="hidden" name="idcct" value="{{Session::get('sessionicct')}}">
                                                            <input type="hidden" name="activo" value="Si">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Escuela</label>
                                                            <input type="text" class="form-control" name="esc" value="{{Session::get('sessioncctnom')}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">C.C.T</label>
                                                            <input type="email" class="form-control" name="cct" value="{{Session::get('sessioncctesc')}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($datos as $d)
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nombre(s)</label>
                                                            <input type="hidden" name="idal" value="{{$d->idal}}">
                                                            <input type="text" class="form-control" name="nom" value="{{$d->nomalu}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">CURP</label>
                                                            <input type="text" class="form-control" name="curp" value="{{$d->curp}}" onKeyUp="this.value=this.value.toUpperCase();">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Matricula</label>
                                                            <input type="text" class="form-control" name="matricula" value="{{$d->matricula}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Sexo</label>
                                                            @if($d->sexo=='M')
                                                                <input type="radio" name="sexo" value="M" checked>Masculino<br>
                                                                <input type="radio" name="sexo" value="F">Femenino
                                                            @else
                                                            	<input type="radio" name="sexo" value="M">Masculino<br>
                                                                <input type="radio" name="sexo" value="F" checked>Femenino
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Grado</label>
                                                            <select class="form-control" name='grupo'>
                                                                    <option value='{{$d->idgru}}'>{{$d->grado}}° - Grupo {{$d->grupo}} - {{$d->cicloesc}}</option>
                                                                    @foreach($grupos as $g)
                                                                    	<option value='{{$g->idgru}}'>{{$g->grado}}° - Grupo {{$g->grupo}} - {{$g->cicloesc}}</option>
                                                                    @endforeach
                                                            </select>
                                                        <span class="material-input"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <button type="submit" class="btn btn-primary pull-right" data-background-color="red">Guardar</button>
                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection