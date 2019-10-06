@extends('dashprofesores.dashboard')
@section('titulo')
	Modificacion de Contraseña
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
	Modifica Contraseña
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
                                    <h4 class="title">DATOS DE PERFIL</h4>
                                    <p class="category">Solo puedes modificar tu CURP y contraseña</p>
                                </div>
                                <div class="card-content">
                                    <div id="typography">
                                        <div class="card-content">
                                            <form action="{{route('gmodifpro')}}" method="POST">
                                                {{csrf_field()}} <!-- Para indicar el uso de formulario -->
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Escuela</label>
                                                            <input type="text" class="form-control" name="esc" value="{{Session::get('sessioncctnom')}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">C.C.T</label>
                                                            <input type="email" class="form-control" name="cct" value="{{Session::get('sessioncctesc')}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($docentes as $doc)
                                                <input type='hidden' name='idd' value="{{$doc->idd}}">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nombre(s)</label>
                                                            <input type="hidden" name="idd" value="{{$doc->idd}}" 
                                                            <input type="text" class="form-control" name="nom" value="{{$doc->nomDoc}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">CURP</label>
                                                            <input type="text" class="form-control" name="curp" value="{{$doc->curp}}" onKeyUp="this.value=this.value.toUpperCase();">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Contraseña</label>
                                                            <input type="text" class="form-control" name="pass" value="{{$doc->pass}}" onKeyUp="this.value=this.value.toUpperCase();">
                                                        </div>
                                                    </div>  
                                                </div>
                                                @endforeach
                                                <button type="submit" class="btn btn-primary pull-right" data-background-color="red">Guardar</button>
                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection