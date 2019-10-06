@extends('login.app2')

@section('Contenido')
	<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('login2/images/Imagen2.jpg')}});">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{route('valida')}}" method="POST">
					{{csrf_field()}} <!-- Para indicar el uso de formulario -->
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Bienvenido
					</span>
					<div>
						<center>
						<input type="radio" name="selection" value="prof">Profesor
						<input type="radio" name="selection" value="adm">Administrativo
						</center>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingrese CURP">
						<input class="input100" type="text" name="curp" placeholder="CURP">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Ingrese contraseña">
						<input class="input100" type="password" name="pass" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
				@if (Session::has('error'))
					<div>{{Session::get('error')}}</div>
					<!--
					<script>
						alert("{{Session::get('error')}}");
					</script>-->
				@endif
			</div>
		</div>
	</div>
@endsection