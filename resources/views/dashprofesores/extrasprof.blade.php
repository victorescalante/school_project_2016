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
                                    <h4 class="title">{{$materia}} - Extraordinarios</h4>
                                    <p class="category">@foreach($grupos as $g)Grado: {{$g->grado}}     Grupo: {{$g->grupo}} @endforeach </p>
                                    <p class="category"><b>Para almacenar las calificaciones da clic en el boton "Guardar" al final de la tabla</b></p>

                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Nombre</th>
                                            <th>Promedio Evs</th>
                                            <th>Extra por</th>
                                            <th>Extra 1</th>
                                            <th>Extra 2</th>
                                            <th>Extra 3</th>
                                            <th>Extra Especial</th>
                                            
                                        </thead>
                                        <tbody>
                                            <form action="{{route('gcalifex')}}" method="POST">
                                            {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                            <input type="hidden" name="idgru" value="{{$idgru}}">
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
                                                                    <input type="hidden" value="{{$fechaact=date('Y-m-d')}}">
                                                                    <!-- Primer if para temporizador-->
                                                                    @foreach($fechasex1 as $fe1)
                                                                        <input type="hidden" value="{{$finicio=$fe1->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe1->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex1[]" value="{{$c->ex1}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex1[]" value="{{$c->ex1}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex1[]" value="{{$c->ex1}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasex2 as $fe2)
                                                                        <input type="hidden" value="{{$finicio=$fe2->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe2->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex2[]" value="{{$c->ex2}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex2[]" value="{{$c->ex2}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex2[]" value="{{$c->ex2}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasex3 as $fe3)
                                                                        <input type="hidden" value="{{$finicio=$fe3->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe3->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex3[]" value="{{$c->ex3}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex3[]" value="{{$c->ex3}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex3[]" value="{{$c->ex3}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasexp as $fep)
                                                                        <input type="hidden" value="{{$finicio=$fep->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fep->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="exp[]" value="{{$c->exp}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="exp[]" value="{{$c->exp}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="exp[]" value="{{$c->exp}}"></td>
                                                                            @endif
                                                                    @endforeach
                                                                </tr>
                                                            @else
                                                                @if($c->promedio<'6')
                                                                <tr>
                                                                    <input type='hidden' name='idev[]' value="{{$c->idev}}">
                                                                    <td>{{$c->nalu}}</td>
                                                                    <td>{{$c->promedio}}</td>
                                                                    <td>E.E.P.C</td>
                                                                    <input type="hidden" value="{{$fechaact=date('Y-m-d')}}">
                                                                    <!-- Primer if para temporizador-->
                                                                    @foreach($fechasex1 as $fe1)
                                                                        <input type="hidden" value="{{$finicio=$fe1->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe1->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex1[]" value="{{$c->ex1}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex1[]" value="{{$c->ex1}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex1[]" value="{{$c->ex1}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasex2 as $fe2)
                                                                        <input type="hidden" value="{{$finicio=$fe2->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe2->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex2[]" value="{{$c->ex2}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex2[]" value="{{$c->ex2}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex2[]" value="{{$c->ex2}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasex3 as $fe3)
                                                                        <input type="hidden" value="{{$finicio=$fe3->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fe3->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="ex3[]" value="{{$c->ex3}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="ex3[]" value="{{$c->ex3}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="ex3[]" value="{{$c->ex3}}"></td>
                                                                            @endif
                                                                    @endforeach

                                                                     @foreach($fechasexp as $fep)
                                                                        <input type="hidden" value="{{$finicio=$fep->fecha_inicio}}">
                                                                        <input type="hidden" value="{{$ffin=$fep->fecha_fin}}">
                                                                            @if($fechaact>=$finicio)
                                                                                @if($fechaact<=$ffin)
                                                                                    <td><input type="text" name="exp[]" value="{{$c->exp}}"></td>   
                                                                                @else
                                                                                    <td>Sin Acciones<input type="hidden" name="exp[]" value="{{$c->exp}}"></td>
                                                                                @endif
                                                                            @else
                                                                                <td>Sin Acciones<input type="hidden" name="exp[]" value="{{$c->exp}}"></td>
                                                                            @endif
                                                                    @endforeach
                                                                </tr>
                                                                @endif
                                                            @endif
                                                           
                                                         @endforeach 
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