@extends('dashboard.dashboard')
@section('titulo')
	Buscador de Profesores
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
	Buscar profesor
@endsection

@section('Contenido')
 @if (Session::has('msage'))
            <script>
                alert("{{Session::get('msage')}}");
            </script>
    @endif
 

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Lista de profesores</h4>
                                    <p class="category">Selecciona un nombre</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('groupsadm')}}" method="POST">
                                        {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                        <div class="form-group  is-empty">
                                            <!-- <input type="select" class="form-control" placeholder="Ingresa nombre"> -->
                                            <select class="form-control" name='prof'>
                                                @foreach($consulta as $c)
                                                    <option value='{{$c->iddoc}}'>{{$c->nombre}}</option>
                                                @endforeach
                                            </select>
                                            <span class="material-input"></span>
                                        </div>
                                        <br><button type="submit" class="btn btn-primary pull-right" data-background-color="red">BUSCAR</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
	 <!--<div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">{{Session::get('sessioncctnom')}}</h4>
                                    <p class="category"><!-- C.C.T: {{Session::get('sessioncctesc')}} Turno: POR DEFINIR Administrativo: {{Session::get('sessionnombdir')}}</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="title">
                                            <h2>Bienvenido</h2>
                                        </div>
                                        <!-- <div class="title">
                                            <h4>{{Session::get('sessionnombdoc')}}</h4>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> -->
@endsection
