@extends('dashboard.dashboard')
@section('titulo')
	Tus grupos
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
    Grupos
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
                                    <h4 class="title">Lista de grupos a cargo</h4>
                                    <p class="category">Profesor a cargo: @foreach($consulta2 as $c2){{ $c2->nomprof }} @endforeach</p>
                                </div>
                                <div class="card-content table-responsive">
                                    @if(count($consulta)>0)
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Grado</th>
                                            <th>Grupo</th>
                                            <th>Materia</th>
                                            <th>Semestre</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            @foreach($consulta as $c)
                                            <tr>
                                                <td>{{$c->grado}}</td>
                                                <td>{{$c->grupo}}</td>
                                                <td>{{$c->materia}}</td>
                                                <td>{{$c->semestre}}</td>
                                                <!-- <td>{{$c->materia}} {{$c->nombre}}</td> -->
                                                <td>
                                                    <form action="{{route('exgroupadm')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="materia" value="{{$c->materia}}">
                                                        <input type="hidden" name="nombre" value="{{$c->nombre}}">
                                                        <input type="hidden" name="idgru" value="{{$c->idgru}}">
                                                        <input type="submit" value="Entrar" class="btn btn-primary" data-background-color="red"></a>
                                                    </form>
                                                    <form action="{{route('egadm')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="materia" value="{{$c->materia}}">
                                                        <input type="hidden" name="nombre" value="{{$c->nombre}}">
                                                        <input type="hidden" name="idgru" value="{{$c->idgru}}">
                                                        <input type="submit" value="Extras" class="btn btn-primary" data-background-color="red"></a>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                        <!-- PDF DE CALIFICACIONES GENERALES -->
                                        <form action="{{route('pdfgp')}}" method="POST">
                                            {{csrf_field()}}
                                            @foreach($consulta2 as $c2)
                                                <input type="hidden" name="prof" value="{{ $c2->iddoc }}">
                                                <input type="hidden" name="nomprof" value="{{ $c2->nomprof }}">
                                             @endforeach
                                            <input type="submit" class="btn btn-primary pull-left" data-background-color="red" value="Crear PDF">
                                        </form>
                                    @else
                                                Sin registros<br>
                                                Este profesor aun no tiene grupos relacionados<br>
                                    @endif
                                </div>
                            </div>

    
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Materias del profesor
                                    </h4>
                                    <p class="category">Profesor a cargo: @foreach($consulta2 as $c2){{ $c2->nomprof }} @endforeach</p>
                                </div>
                                <div class="card-content table-responsive">
                                    @if(count($consulta3)>0)
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Materia</th>
                                            <th>Semestre</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                                @foreach($consulta3 as $c3)
                                                <tr>
                                                    <td>{{$c3->nmateria}}</td>
                                                    <td>{{$c3->semestre}}</td>
                                                    <td><form action="{{route('cambiahoras')}}" method="POST">{{csrf_field()}}<input type='hidden' name='idam' value="{{$c3->idam}}"><input type="hidden" name="nombre" value="@foreach($consulta2 as $c2){{ $c2->nomprof }} @endforeach"><input type="submit" value="Cambiar horas" class="btn btn-primary" data-background-color="red"></a></form></td>
                                                </tr>
                                                @endforeach
                                                
                                        </tbody>
                                    </table>
                                    @else
                                                Sin registros<br>
                                                Para agregar materias a este docente da clic en el boton "Agregar"<br>
                                    @endif
                                    <form action="{{route('rmprof')}}" method="POST">{{csrf_field()}}<input type="hidden" name="nombre" value="@foreach($consulta2 as $c2){{ $c2->nomprof }} @endforeach"><input type="submit" value="Agregar" class="btn btn-primary" data-background-color="red"></a></form>
                                </div>
                            </div>
                        </div>
@endsection