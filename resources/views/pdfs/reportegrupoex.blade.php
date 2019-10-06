<html>
<head>
	<title>nuevo pdf</title>
	<style>
	  @font-face {
	    font-family: 'Arial';
	    font-weight: normal;
	    font-style: normal;
	    font-variant: normal;
	  }
	  body {
	    font-family: Arial, sans-serif;
	  }
	</style>
</head>
<body>
		<div>
			<img align="left" src="{{asset('img/logogob1.png')}}" width='150'><img align="right" src="{{asset('img/edomex3.png')}}" width='150'>
		</div>
		<br><br><br>Materia: {{$materia}}<br>
		Profesor: {{$nombre}}<br>
		@foreach($grupos as $g)Grado: {{$g->grado}}     Grupo: {{$g->grupo}} @endforeach <br>

		<center><H2>REPORTE DE INCONSISTENCIAS Evaluacion Extraordinaria</H2></center>
		<P>*** LAS INCONSISTENCIAS ESTAN SEÑALADAS EN COLOR <font color="red">ROJO</font></P>

		<table border=1>
			<tr>
				<th width="150">Nombre Alumno</th>
				<th>Promedio</th>
				<th>Razon Extra</th>
				<th>1° Extra</th>
				<th>2° Extra</th>
				<th>3° Extra</th>
				<th>Extra Especial</th>
			</tr>
			@foreach($consulta as $c)
				@foreach($horas as $h)
                	<input type='hidden' value="{{$f=$c->f1+$c->f2}}">
                    <input type='hidden' value="{{$pt=$h->horas}}">
                    <input type='hidden' value="{{$pf=($f*100)/$pt}}">
                    @if($pf>20)	
						<tr align="center">
							<td align="left">{{$c->nalu}}</td>
							<td>{{$c->promedio}}</td>
							<td>E.E.P.F</td>
							@if($c->aex1=='No')
								<td><font color="red">{{$c->ex1}}</font></td>
							@else
								<td>{{$c->ex1}}</td>
							@endif
							<!-- ******************************************************************************************** --> 
							@if($c->aex2=='No')
								<td><font color="red">{{$c->ex2}}</font></td>
							@else
								<td>{{$c->ex2}}</td>
							@endif
							<!-- ******************************************************************************************** --> 
							@if($c->aex3=='No')
								<td><font color="red">{{$c->ex3}}</font></td>
							@else
								<td>{{$c->ex3}}</td>
							@endif
							
							<!-- ******************************************************************************************** --> 
							@if($c->aexp=='No')
								<td><font color="red">{{$c->exp}}</font></td>
							@else
								<td>{{$c->exp}}</td>
							@endif
							<!-- ******************************************************************************************** --> 
						</tr>
					@else
                        @if($c->promedio<'6')
                        	<tr align="center">
								<td align="left">{{$c->nalu}}</td>
								<td>{{$c->promedio}}</td>
								<td>E.E.P.C</td>
								@if($c->aex1=='No')
								<td><font color="red">{{$c->ex1}}</font></td>
								@else
									<td>{{$c->ex1}}</td>
								@endif
								<!-- ******************************************************************************************** --> 
								@if($c->aex2=='No')
									<td><font color="red">{{$c->ex2}}</font></td>
								@else
									<td>{{$c->ex2}}</td>
								@endif
								<!-- ******************************************************************************************** --> 
								@if($c->aex3=='No')
									<td><font color="red">{{$c->ex3}}</font></td>
								@else
									<td>{{$c->ex3}}</td>
								@endif
								
								<!-- ******************************************************************************************** --> 
								@if($c->aexp=='No')
									<td><font color="red">{{$c->exp}}</font></td>
								@else
									<td>{{$c->exp}}</td>
								@endif
							</tr>
                        @endif
                    @endif
                @endforeach 
			@endforeach
		</table>
</body>
</html>