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
                                    <h4 class="title">{{$materia}} - Extraordinarios</h4>
                                    <p class="category">Profesor: {{$nombre}}</p>
                                    <p class="category">@foreach($grupos as $g)Grado: {{$g->grado}}     Grupo: {{$g->grupo}} @endforeach </p>
                                    <p class="category"><b>Es necesario que valide todos los campos para continuar ***</b></p>
                                    <p class="category"><b>Por aprobación selecciona solo una opcion "Si" o "No", antes de continuar, verifique que solo haya una opcion por aprobacion seleccionada ***</b></p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Nombre</th>
                                            <th>Promedio</th>
                                            <th>Razon Extra</th>
                                            <th>1° Extra</th>
                                            <th>1° Aprobacion</th>
                                            <th>2° Extra</th>
                                            <th>2° Aprobacion</th>
											<th>3° Extra</th>
                                            <th>3° Aprobacion</th>
                                            <th>Extra Especial</th>
                                            <th>Aprobacion Extra Especial</th>
                                            
                                        </thead>
                                        <tbody>
                                            <form action="{{route('gaprobex')}}" method="POST">
                                            {{csrf_field()}} <!-- Para indicar el uso de formulario -->

                                            <input type="hidden" name="idgru" value="@foreach($grupos as $gr){{$gr->idgru}}@endforeach">
                                            <input type="hidden" name="nombre" value="{{$nombre}}">
                                            <input type="hidden" name="materia" value="{{$materia}}">

                                            @foreach($consulta as $c)
                                            	@foreach($horas as $h)
                                                    <input type='hidden' value="{{$f=$c->f1+$c->f2}}">
                                                    <input type='hidden' value="{{$pt=$h->horas}}">
                                                    <input type='hidden' value="{{$pf=($f*100)/$pt}}">
                                                    	@if($pf>20)
                                                    		<tr>
			                                                <input type='hidden' name='idev[]' value="{{$c->idev}}">
			                                                <td>{{$c->nalu}}</td>
			                                                <td>{{$c->promedio}}</td>
			                                                <td>E.E.P.F</td>
			                                                <td>{{$c->ex1}}</td>
			                                                @if($c->aex1=='Si')
			                                                    <td><input type='checkbox' name='aex1[]' value="Si" checked>Si <input type='checkbox' name='aex1[]' value="No">No</td>
			                                                @else
			                                                    @if($c->aex1=='No')
			                                                        <td><input type='checkbox' name='aex1[]' value="Si">Si <input type='checkbox' name='aex1[]' value="No" checked>No</td>
			                                                    @else
			                                                        <td><input type='checkbox' name='aex1[]' value="Si">Si <input type='checkbox' name='aex1[]' value="No">No</td>
			                                                    @endif
			                                                @endif
			                                                <!-- ************************************* -->
			                                                <td>{{$c->ex2}}</td>
			                                                @if($c->aex2=='Si')
			                                                    <td><input type='checkbox' name='aex2[]' value="Si" checked>Si<input type='checkbox' name='aex2[]' value="No">No</td>
			                                                @else
			                                                    @if($c->aex2=='No')
			                                                        <td><input type='checkbox' name='aex2[]' value="Si">Si <input type='checkbox' name='aex2[]' value="No" checked>No</td>
			                                                    @else
			                                                        <td><input type='checkbox' name='aex2[]' value="Si">Si <input type='checkbox' name='aex2[]' value="No">No</td>
			                                                    @endif
			                                                @endif
			                                                <!-- ************************************* -->
			                                                <td>{{$c->ex3}}</td>
			                                                @if($c->aex3=='Si')
			                                                    <td><input type='checkbox' name='aex3[]' value="Si" Checked>Si<input type='checkbox' name='aex3[]' value="No">No</td>
			                                                @else
			                                                    @if($c->aex3=='No')
			                                                        <td><input type='checkbox' name='aex3[]' value="Si">Si <input type='checkbox' name='aex3[]' value="No" checked>No</td>
			                                                    @else
			                                                        <td><input type='checkbox' name='aex3[]' value="Si">Si <input type='checkbox' name='aex3[]' value="No">No</td>
			                                                    @endif
			                                                @endif
			                                                <!-- ************************************* -->
			                                                <td>{{$c->exp}}</td>
			                                                @if($c->aexp=='Si')
			                                                    <td><input type='checkbox' name='aexp[]' value="Si" checked>Si<input type='checkbox' name='aexp[]' value="No">No</td>
			                                                @else
			                                                     @if($c->aexp=='No')
			                                                        <td><input type='checkbox' name='aexp[]' value="Si">Si <input type='checkbox' name='aexp[]' value="No" checked>No</td>
			                                                    @else
			                                                        <td><input type='checkbox' name='aexp[]' value="Si">Si <input type='checkbox' name='aexp[]' value="No">No</td>
			                                                    @endif
			                                                @endif
			                                                <!-- ************************************* -->
			                                            	</tr>
                                                    	@else
                                                            @if($c->promedio<'6')
                                                            	<tr>
				                                                <input type='hidden' name='idev[]' value="{{$c->idev}}">
				                                                <td>{{$c->nalu}}</td>
				                                                <td>{{$c->promedio}}</td>
				                                                <td>E.E.P.C</td>
				                                                <td>{{$c->ex1}}</td>
				                                                @if($c->aex1=='Si')
				                                                    <td><input type='checkbox' name='aex1[]' value="Si" checked>Si <input type='checkbox' name='aex1[]' value="No">No</td>
				                                                @else
				                                                    @if($c->aex1=='No')
				                                                        <td><input type='checkbox' name='aex1[]' value="Si">Si <input type='checkbox' name='aex1[]' value="No" checked>No</td>
				                                                    @else
				                                                        <td><input type='checkbox' name='aex1[]' value="Si">Si <input type='checkbox' name='aex1[]' value="No">No</td>
				                                                    @endif
				                                                @endif
				                                                <!-- ************************************* -->
				                                                <td>{{$c->ex2}}</td>
				                                                @if($c->aex2=='Si')
				                                                    <td><input type='checkbox' name='aex2[]' value="Si" checked>Si<input type='checkbox' name='aex2[]' value="No">No</td>
				                                                @else
				                                                    @if($c->aex2=='No')
				                                                        <td><input type='checkbox' name='aex2[]' value="Si">Si <input type='checkbox' name='aex2[]' value="No" checked>No</td>
				                                                    @else
				                                                        <td><input type='checkbox' name='aex2[]' value="Si">Si <input type='checkbox' name='aex2[]' value="No">No</td>
				                                                    @endif
				                                                @endif
				                                                <!-- ************************************* -->
				                                                <td>{{$c->ex3}}</td>
				                                                @if($c->aex3=='Si')
				                                                    <td><input type='checkbox' name='aex3[]' value="Si" Checked>Si<input type='checkbox' name='aex3[]' value="No">No</td>
				                                                @else
				                                                    @if($c->aex3=='No')
				                                                        <td><input type='checkbox' name='aex3[]' value="Si">Si <input type='checkbox' name='aex3[]' value="No" checked>No</td>
				                                                    @else
				                                                        <td><input type='checkbox' name='aex3[]' value="Si">Si <input type='checkbox' name='aex3[]' value="No">No</td>
				                                                    @endif
				                                                @endif
				                                                <!-- ************************************* -->
				                                                <td>{{$c->exp}}</td>
				                                                @if($c->aexp=='Si')
				                                                    <td><input type='checkbox' name='aexp[]' value="Si" checked>Si<input type='checkbox' name='aexp[]' value="No">No</td>
				                                                @else
				                                                     @if($c->aexp=='No')
				                                                        <td><input type='checkbox' name='aexp[]' value="Si">Si <input type='checkbox' name='aexp[]' value="No" checked>No</td>
				                                                    @else
				                                                        <td><input type='checkbox' name='aexp[]' value="Si">Si <input type='checkbox' name='aexp[]' value="No">No</td>
				                                                    @endif
				                                                @endif
				                                                <!-- ************************************* -->
				                                            	</tr>
                                                         	@endif
                                                        @endif
                                                @endforeach 
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                            <button type="submit" class="btn btn-primary pull-right" data-background-color="green">Validar</button>
                                            </form>
                                        <form action="{{route('repincex')}}" method="POST">
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