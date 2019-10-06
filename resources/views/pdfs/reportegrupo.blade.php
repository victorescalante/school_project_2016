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

		<center><H2>REPORTE DE INCONSISTENCIAS</H2></center>
		<P>*** LAS INCONSISTENCIAS ESTAN SEÑALADAS EN COLOR <font color="red">ROJO</font></P>

		<table border=1>
			<tr>
				<th width="150">Nombre Alumno</th>
				<th>1° Evaluacion</th>
				<th>1° Faltas</th>
				<th>2° Evaluacion</th>
				<th>2° Faltas</th>
				<th>Prom.</th>
				<th>Status</th>
			</tr>
			@foreach($consulta as $c)	
			<tr align="center">
					<td align="left">{{$c->nalu}}</td>
					@if($c->ap1=='No')
						<td><font color="red">{{$c->ev1}}</font></td>
					@else
						<td>{{$c->ev1}}</td>
					@endif
					<!-- ******************************************************************************************** --> 
					@if($c->af1=='No')
						<td><font color="red">{{$c->f1}}</font></td>
					@else
						<td>{{$c->f1}}</td>
					@endif
					<!-- ******************************************************************************************** --> 
					@if($c->ap2=='No')
						<td><font color="red">{{$c->ev2}}</font></td>
					@else
						<td>{{$c->ev2}}</td>
					@endif
					
					<!-- ******************************************************************************************** --> 
					@if($c->af2=='No')
						<td><font color="red">{{$c->f2}}</font></td>
					@else
						<td>{{$c->f2}}</td>
					@endif
					<!-- ******************************************************************************************** --> 
					<td><b>{{$c->promedio}}</b></td>
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
		</table>
</body>
</html>