@extends('dashprofesores.dashboard')
@section('titulo')
	Grupo Administrado
@endsection

@section('menus')
                <ul class="nav">
                    <li class="active">
                        <a href="{{URL::action('calif@index')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::action('calif@groups')}}">
                            <i class="material-icons">content_paste</i>
                            <p>Tus Grupos</p>
                        </a>
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
                                    <p class="category">@foreach($grupos as $g)Grado: {{$g->grado}}     Grupo: {{$g->grupo}} @endforeach </p>
                                    <p class="category"><b>Para almacenar las calificaciones da clic en el boton "Guardar" al final de la tabla</b></p>

                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Nombre</th>
                                            <th>1° Evaluacion</th>
                                            <th>Faltas 1°</th>
                                            <th>2° Evaluacion</th>
                                            <th>Faltas 2°</th>
                                            <th>Promedio</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <form action="{{route('gcalif')}}" method="POST">
                                            {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                            <input type="hidden" name="idgru" value="{{$idgru}}">
                                            <input type="hidden" name="materia" value="{{$materia}}">
                                            @foreach($consulta as $c)
                                            <tr>
                                                <input type='hidden' name='idev[]' value="{{$c->idev}}">
                                                <td>{{$c->nalu}}</td>
                                                <input type="hidden" value="{{$fechaact=date('Y-m-d')}}">
                                                <!-- Primer if para temporizador-->
                                                @foreach($fechasev1 as $fe1)
                                                    <input type="hidden" value="{{$finicio=$fe1->fecha_inicio}}">
                                                    <input type="hidden" value="{{$ffin=$fe1->fecha_fin}}">
                                                        @if($fechaact>=$finicio)
                                                            @if($fechaact<=$ffin)
                                                                <td><input type="text" name="ev1[]" value="{{$c->ev1}}"></td>
                                                                <td><input type="text" name="f1[]" value="{{$c->f1}}"></td>
                                                            @else
                                                                <td>Sin Acciones<input type="hidden" name="ev1[]" value="{{$c->ev1}}"></td>
                                                                <td>Sin Acciones<input type="hidden" name="f1[]" value="{{$c->f1}}"></td>
                                                            @endif
                                                        @else
                                                            <td>Sin Acciones<input type="hidden" name="ev1[]" value="{{$c->ev1}}"></td>
                                                            <td>Sin Acciones<input type="hidden" name="f1[]" value="{{$c->f1}}"></td>
                                                        @endif
                                                @endforeach
                                                <!--Aqui acaba el primer if -->
                                                <!-- Aqui empieza el segundo If-->
                                                @foreach($fechasev2 as $fe2)
                                                    <input type="hidden" value="{{$finicio2=$fe2->fecha_inicio}}">
                                                    <input type="hidden" value="{{$ffin2=$fe2->fecha_fin}}">
                                                        @if($fechaact>$finicio2)
                                                            @if($fechaact<$ffin2)
                                                                <td><input type="text" name="ev2[]" value="{{$c->ev2}}"></td>
                                                                <td><input type="text" name="f2[]" value="{{$c->f2}}"></td>
                                                            @else
                                                                <td>Sin Acciones<input type="hidden" name="ev2[]" value="{{$c->ev2}}"></td>
                                                                <td>Sin Acciones<input type="hidden" name="f2[]" value="{{$c->f2}}"></td>
                                                            @endif
                                                        @else
                                                            <td>Sin Acciones<input type="hidden" name="ev2[]" value="{{$c->ev2}}"></td>
                                                            <td>Sin Acciones<input type="hidden" name="f2[]" value="{{$c->f2}}"></td>
                                                        @endif
                                                @endforeach
                                                <!--Aqui acaba el segundo if -->
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
                                            <button type="submit" class="btn btn-primary pull-right" data-background-color="green">Guardar</button>
                                            </form>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> <!-- fin tabla alumnos -->


@endsection