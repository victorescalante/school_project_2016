@extends('dashboard.dashboard')
@section('titulo')
	Inicio Admin
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
	Inicio Admin
@endsection

@section('Contenido')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">{{Session::get('sessioncctnom')}}</h4>
                                    <p class="category"><!-- C.C.T: {{Session::get('sessioncctesc')}} Turno: POR DEFINIR -->Profesor: {{Session::get('sessionnombdoc')}}</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="title">
                                            <h2>Bienvenido</h2>
                                        </div>
                                        <!-- <div class="title">
                                            <h4>{{Session::get('sessionnombdoc')}}</h4>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
