@extends('dashboard.dashboard')
@section('titulo')
	Lista de Grupos
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
	Grupos registrados 
@endsection

@section('Contenido')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Lista de Grupos
                                    </h4>
                                    <p class="category">...</p>
                                </div>
                                <div class="card-content table-responsive">
                                    @if(count($grupos)>0)
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Grado</th>
                                            <th>Grupo</th>
                                            <th>Ciclo escolar</th>
                                            <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                                @foreach($grupos as $g)
                                                <tr>
                                                    <td>{{$g->grado}}</td>
                                                    <td>{{$g->grupo}}</td>
                                                    <td>{{$g->cicloesc}}</td>
                                                    @if($g->grado==1)
                                                        <td>
                                                            <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>1])}}"><button type="button" class="btn btn-primary" data-background-color="red">1° Semestre</button></a>
                                                            <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>2])}}"><button type="button" class="btn btn-primary" data-background-color="red">2° Semestre</button></a>
                                                        </td>
                                                    @else
                                                        @if($g->grado==2)
                                                            <td>
                                                                <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>3])}}"><button type="button" class="btn btn-primary" data-background-color="red">3° Semestre</button></a>
                                                                <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>4])}}"><button type="button" class="btn btn-primary" data-background-color="red">4° Semestre</button></a>
                                                            </td>
                                                        @else
                                                            @if($g->grado==3)
                                                                <td>
                                                                    <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>5])}}"><button type="button" class="btn btn-primary" data-background-color="red">5° Semestre</button></a>
                                                                    <a href="{{URL::action('calif@exadmgrupo',['idgru'=>$g->idgru,'semestre'=>6])}}"><button type="button" class="btn btn-primary" data-background-color="red">6° Semestre</button></a>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </tr>
                                                @endforeach
                                                
                                        </tbody>
                                    </table>
                                    @else
                                                Sin registros<br>
                                                Para agregar grupos ve al menu desplegable "Grupos" y da clic en "Generar Grupo"<br>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
@endsection