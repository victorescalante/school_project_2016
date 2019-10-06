@extends('dashboard.dashboard')
@section('titulo')
    Evaluaciones
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
    Evaluaciones
@endsection

@section('Contenido')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Evaluaciones Regulares</h4>
                                    <p class="category">Esccoge la evaluación que desee temporizar</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="card-content">
                                            <form action="{{route('gprof')}}" method="POST">
                                                {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                                <div class="row">
                                                    <div class="col-md-5">
                                                            <input type="hidden" name="idcct" value="{{Session::get('sessionicct')}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h4 class="title">1° Extraordinario</h4>
                                                        <a href="{{URL::action('calif@extra_uno')}}"><input type="button" class="btn btn-primary pull-left" data-background-color="red" value='Ingresar'></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">                                                
                                                        <h4 class="title">2° Extraordinario</h4>
                                                        <a href="{{URL::action('calif@extra_dos')}}"><input type="button" class="btn btn-primary pull-left" data-background-color="red" value='Ingresar'></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">                                                
                                                        <h4 class="title">3° Extraordinario</h4>
                                                        <a href="{{URL::action('calif@extra_tres')}}"><input type="button" class="btn btn-primary pull-left" data-background-color="red" value='Ingresar'></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">                                                
                                                        <h4 class="title">Extraordinario Especial</h4>
                                                        <a href="{{URL::action('calif@extra_esp')}}"><input type="button" class="btn btn-primary pull-left" data-background-color="red" value='Ingresar'></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection