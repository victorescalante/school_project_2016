@extends('dashboard.dashboard')
@section('titulo')
	Grupo Administrado
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
	Grupo Administrado
@endsection

@section('Contenido')
        @if (Session::has('msage'))
            <script>
                alert("{{Session::get('msage')}}");
            </script>
        @endif
	                   <div class="col-md-12"> <!-- inicio tabla alumnos y calificaciones -->
                            <div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">{{$materia}}</h4>
                                    <p class="category">Profesor: {{$nombre}}</p>
                                    <p class="category">@foreach($grupos as $g)Grado: {{$g->grado}}     Grupo: {{$g->grupo}} @endforeach </p>
                                    <p class="category"><b>Es necesario que valide todos los campos para continuar ***</b></p>
                                    <p class="category"><b>Por aprobación selecciona solo una opcion "Si" o "No", antes de continuar, verifique que solo haya una opcion por aprobacion seleccionada ***</b></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Nombre</th>
                                            <th>1° Evaluacion</th>
                                            <th>1° Aprobacion</th>
                                            <th>2° Evaluacion</th>
                                            <th>2° Aprobacion</th>
                                            <th>Faltas 1°</th>
                                            <th>Aprobacion 1</th>
                                            <th>Faltas 2°</th>
                                            <th>Aprobacion 2</th>
                                            <th>Promedio</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <form action="{{route('gaprob')}}" method="POST">
                                            {{csrf_field()}} <!-- Para indicar el uso de formulario -->

                                            <input type="hidden" name="idgru" value="@foreach($grupos as $gr){{$gr->idgru}}@endforeach">
                                            <input type="hidden" name="nombre" value="{{$nombre}}">
                                            <input type="hidden" name="materia" value="{{$materia}}">

                                            @foreach($consulta as $c)
                                            <tr>
                                                <input type='hidden' name='idev[]' value="{{$c->idev}}">
                                                <td>{{$c->nalu}}</td>
                                                <td>{{$c->ev1}}</td>
                                                @if($c->ap1=='Si')
                                                    <td><input type='checkbox' name='aprov1[]' value="Si" checked>Si <input type='checkbox' name='aprov1[]' value="No">No</td>
                                                @else
                                                    @if($c->ap1=='No')
                                                        <td><input type='checkbox' name='aprov1[]' value="Si">Si <input type='checkbox' name='aprov1[]' value="No" checked>No</td>
                                                    @else
                                                        <td><input type='checkbox' name='aprov1[]' value="Si">Si <input type='checkbox' name='aprov1[]' value="No">No</td>
                                                    @endif
                                                @endif
                                                <!-- ************************************* -->
                                                <td>{{$c->ev2}}</td>
                                                @if($c->ap2=='Si')
                                                    <td><input type='checkbox' name='aprov2[]' value="Si" checked>Si<input type='checkbox' name='aprov2[]' value="No">No</td>
                                                @else
                                                    @if($c->ap2=='No')
                                                        <td><input type='checkbox' name='aprov2[]' value="Si">Si <input type='checkbox' name='aprov2[]' value="No" checked>No</td>
                                                    @else
                                                        <td><input type='checkbox' name='aprov2[]' value="Si">Si <input type='checkbox' name='aprov2[]' value="No">No</td>
                                                    @endif
                                                @endif
                                                <!-- ************************************* -->
                                                <td>{{$c->f1}}</td>
                                                @if($c->af1=='Si')
                                                    <td><input type='checkbox' name='af1[]' value="Si" Checked>Si<input type='checkbox' name='af1[]' value="No">No</td>
                                                @else
                                                    @if($c->af1=='No')
                                                        <td><input type='checkbox' name='af1[]' value="Si">Si <input type='checkbox' name='af1[]' value="No" checked>No</td>
                                                    @else
                                                        <td><input type='checkbox' name='af1[]' value="Si">Si <input type='checkbox' name='af1[]' value="No">No</td>
                                                    @endif
                                                @endif
                                                <!-- ************************************* -->
                                                <td>{{$c->f2}}</td>
                                                @if($c->af2=='Si')
                                                    <td><input type='checkbox' name='af2[]' value="Si" checked>Si<input type='checkbox' name='af2[]' value="No">No</td>
                                                @else
                                                     @if($c->af1=='No')
                                                        <td><input type='checkbox' name='af2[]' value="Si">Si <input type='checkbox' name='af2[]' value="No" checked>No</td>
                                                    @else
                                                        <td><input type='checkbox' name='af2[]' value="Si">Si <input type='checkbox' name='af2[]' value="No">No</td>
                                                    @endif
                                                @endif
                                                <!-- ************************************* -->
                                                <td>{{$c->promedio}}</td>
                                                @if($c->promedio<'6')
                                                    <td>E.E.P.C</td>
                                                @else
                                                    @foreach($horas as $h)
                                                        <input type='hidden' value="{{$f=$c->f1+$c->f2}}">
                                                        <input type='hidden' value="{{$pt=$h->horas}}">
                                                        <input type='hidden' value="{{$pf=($f*100)/$pt}}">
                                                        
                                                        @if($pf>20)
                                                            <td>E.E.P.F</td>
                                                        @else
                                                            <td>Regular</td>
                                                        @endif
                                                    @endforeach 
                                                @endif
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                            <button type="submit" class="btn btn-primary pull-right" data-background-color="green">Validar</button>
                                            </form>
                                        <form action="{{route('repinc')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="idgru" value="@foreach($grupos as $gr){{$gr->idgru}}@endforeach">
                                            <input type="hidden" name="nombre" value="{{$nombre}}">
                                            <input type="hidden" name="materia" value="{{$materia}}">
                                            <input type="submit" class="btn btn-primary pull-right" data-background-color="green" value="Crear PDF">
                                          </form>
                                        <!-- <button type="submit" class="btn btn-primary pull-right" data-background-color="green">Generar Reporte</button> -->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> <!-- fin tabla alumnos -->


@endsection