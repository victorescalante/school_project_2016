@extends('dashboard.dashboard')
@section('titulo')
	Profesor administrado
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
	Agregar Materias 
@endsection

@section('Contenido')

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Selecciona Materia a agregar</h4>
                                    <p class="category">Profesor: @foreach($prof as $p) {{$p->nomDoc}} @endforeach</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('grmprof')}}" method="POST">
                                        {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                        <div class="form-group  is-empty">
                                            <!-- <input type="select" class="form-control" placeholder="Ingresa nombre"> -->
                                            <input type="hidden" name="id" value="@foreach($prof as $p) {{$p->idd}} @endforeach">
                                            <select class="form-control" name='mat'>
                                                @foreach($materias as $m)
                                                    <option value='{{$m->idm}}'>{{$m->semestre}}° Semestre - {{$m->nommat}}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Horas</label>
                                                <input type="text" name="horas" class="form-control">
                                            </div>
                                            <span class="material-input"></span>
                                        </div>
                                        <br><button type="submit" class="btn btn-primary pull-right" data-background-color="red">Asignar</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
@endsection
