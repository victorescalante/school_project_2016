@extends('dashprofesores.dashboard')
@section('titulo')
	Tus grupos
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
    Grupos
@endsection

@section('Contenido')
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Lista de grupos a cargo</h4>
                                    <p class="category">Profesor: {{Session::get('sessionnombdoc')}} </p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Grado</th>
                                            <th>Grupo</th>
                                            <th>Materia</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            @foreach($consulta as $c)
                                            <tr>
                                                <td>{{$c->grado}}</td>
                                                <td>{{$c->grupo}}</td>
                                                <td>{{$c->materia}}</td>
                                                <!-- <td>{{$c->materia}} {{$c->nombre}}</td> -->
                                                <td><form action="{{route('exgroups')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="materia" value="{{$c->materia}}">
                                                        <input type="hidden" name="idgru" value="{{$c->idgru}}">
                                                        <input type="submit" value="Entrar" class="btn btn-primary" data-background-color="red">
                                                    </form>
                                                    <form action="{{route('extrasg')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="materia" value="{{$c->materia}}">
                                                        <input type="hidden" name="idgru" value="{{$c->idgru}}">
                                                        <input type="submit" value="Extras" class="btn btn-primary" data-background-color="red">
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
@endsection