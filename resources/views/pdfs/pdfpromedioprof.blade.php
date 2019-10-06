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
		
		<br>
		<br>
		<center><H2>PROMEDIO GENERAL PROFESOR</H2></center>
 
		<br><b>Institución:</b> {{$scctnom}}
		<br><b>C.C.T:</b> {{$scctesc}}
		<br><b>Profesor(a):</b> {{$nomprof}}
		<br>
		<br>
		<br>A continuación se muestran los grupos a cargo del docente, el promedio general de cada grupo y el promedio general de todos los grupos
		<br>
		<br>
		<table border=0 rules="rows" width="100%">
			<tr>
				<th width="50%">MATERIA</th>
				<th>GRADO</th>
				<th>GRUPO</th>
				<th>PROMEDIO</th>
			</tr>
			@foreach($consulta as $c)
            <tr>
            	<td>{{$c->materia}}</td>
                <td>{{$c->grado}}</td>
                <td>{{$c->grupo}}</td>
                <td>{{round($c->promgral,1)}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan=3><b>PROMEDIO GENERAL:</b></td> 
				<td> 
					<input type="hidden" value="{{$total=0}}">
					<input type='hidden' value="{{$numreg=count($consulta)}}">
					@foreach($consulta as $c2)
						<input type="hidden" value="{{$total+=$c2->promgral}}">
					@endforeach
					<input type="hidden" value="{{$totalgral=$total/$numreg}}">
					{{round($totalgral,1)}}
				</td>
			</tr>
		</table><br><br>
		
</body>
</html>