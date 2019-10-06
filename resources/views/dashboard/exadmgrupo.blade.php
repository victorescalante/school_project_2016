@extends('dashboard.dashboard')
@section('titulo')
	Informacion de Grupo
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
	Informacion General del grupo
@endsection

@section('Contenido')

        @if (Session::has('msage'))
            <script>
                alert("{{Session::get('msage')}}");
            </script>
        @endif
	                   <div class="col-md-12"> <!-- inicio tabla alumnos y calificaciones -->
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Alumnos del grupo</h4>
                                    <p class="category">@foreach($consulta2 as $c2)Grado: {{$c2->grado}}     Grupo: {{$c2->grupo}} @endforeach<br>Total de alumnos: {{$tc3}}<br>{{Session::get('sessioncctnom')}}</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Status</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            @foreach($consulta as $c)
                                            <tr>
                                                <td>{{$c->nomalu}}</td>
                                                <td>{{$c->sexo}}</td>
                                                <td>{{$c->activo}}</td>
                                                <td><a href="{{URL::action('calif@modifalumno',['idal'=>$c->idal])}}"><br><button type="button" class="btn btn-primary" data-background-color="red">Cambiar</button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> <!-- fin tabla alumnos -->

                        <div class="col-md-12"> <!-- inicio tabla alumnos y calificaciones -->
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Materias del grupo</h4>
                                    <p class="category">{{$semestre}}° Semestre - {{Session::get('sessioncctnom')}} - (Antes de agregar una materia, asegurese de que el grupo esta completo)</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Materia</th>
                                            <th>Profesor</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($consulta3 as $c3)
                                            <tr>
                                                <td>{{$c3->materia}}</td>
                                                <td>{{$c3->nombre}}</td>
                                                <td><a href="{{URL::action('calif@cambiaprofmat',['idgru'=>$idgrupo,'idam'=>$c3->idam,'materia'=>$c3->materia,'semestre'=>$semestre,'idm'=>$c3->idm])}}"><button type="button" class="btn btn-primary" data-background-color="red">Cambiar</button></a>
                                                    <a href="{{URL::action('calif@pregdelprof',['idgru'=>$idgrupo,'idam'=>$c3->idam,'prof'=>$c3->nombre,'materia'=>$c3->materia,'semestre'=>$semestre,'idm'=>$c3->idm])}}"><button type="button" class="btn btn-primary" data-background-color="red">Quitar</button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <a href="{{URL::action('calif@asigmatgrupo',['idgru'=>$idgrupo,'semestre'=>$semestre])}}"><br><button type="button" class="btn btn-primary" data-background-color="red">Agregar materia</button></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> <!-- fin tabla alumnos -->
@endsection