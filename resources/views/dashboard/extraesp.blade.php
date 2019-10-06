@extends('dashboard.dashboard')
@section('titulo')
	Fechas de registro Evaluación Extraordinaria Especial
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
	Fechas evaluación
@endsection

@section('Contenido')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Evaluación Extraordinaria Especial</h4>
                                    <p class="category">Ingresa las fechas</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="card-content">
                                            <form action="{{route('gfexesp')}}" method="POST">
                                                {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                                <div class="row">
                                                    <h4 class="title">Fecha de incio Evaluación</h4>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Dia Inicio</label>
                                                            <input type="text" class="form-control" name="diain">
                                                            <input type="hidden" name="tipo" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Mes Inicio</label>
                                                            <select class="form-control" name="mesin">
                                                                <option value="01">Enero</option>
                                                                <option value="02">Febrero</option>
                                                                <option value="03">Marzo</option>
                                                                <option value="04">Abril</option>
                                                                <option value="05">Mayo</option>
                                                                <option value="06">Junio</option>
                                                                <option value="07">Julio</option>
                                                                <option value="08">Agosto</option>
                                                                <option value="09">Septiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Año Inicio</label>
                                                            <input type="text" class="form-control" name="yearin" value="{{$y=date('Y')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <h4 class="title">Fecha fin Evaluación</h4>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Dia Fin</label>
                                                            <input type="text" class="form-control" name="diafin">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Mes Fin</label>
                                                            <select class="form-control" name="mesfin">
                                                                <option value="01">Enero</option>
                                                                <option value="02">Febrero</option>
                                                                <option value="03">Marzo</option>
                                                                <option value="04">Abril</option>
                                                                <option value="05">Mayo</option>
                                                                <option value="06">Junio</option>
                                                                <option value="07">Julio</option>
                                                                <option value="08">Agosto</option>
                                                                <option value="09">Septiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Año Fin</label>
                                                            <input type="text" class="form-control" name="yearfin" value="{{$y=date('Y')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary pull-right" data-background-color="red">Guardar</button>
                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection