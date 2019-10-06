<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\grupos;

use Session;

use DB;

class calif extends Controller
{
	// ***** INTERFAZ PARA PROFESOR *****
    public function index()
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashprofesores.index');
		}
	}

	public function groups()
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('docentes.nomDoc as nombre','docentes.idd as iddoc','grupos.grado as grado','grupos.grupo as grupo','materias.nommat as materia','asiggru.idgru as idgru')
			->distinct()
			->where('docentes.idd',$siddoc)
			->get();
			//echo $consulta;
			return view('dashprofesores.gruposprof')->with('consulta',$consulta);
		}
	}

	public function exgroup(Request $Request)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru');

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get(); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.primeraev as ev1','evaluaciones.segundaev as ev2','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$snombdoc)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			
			$fechasev1=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','1')
			->where('idcct','=',$sicct)
			->get();

			$fechasev2=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','2')
			->where('idcct','=',$sicct)
			->get();
			//echo $fechasev1;
			//echo $fechasev2;
			return view('dashprofesores.exgrupoprof',compact('materia','idgru','horas'))->with('consulta',$consulta)->with('grupos',$grupos)->with('fechasev1',$fechasev1)->with('fechasev2',$fechasev2);
		}
	}

	public function exgroupget($idgru,$materia)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get(); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.primeraev as ev1','evaluaciones.segundaev as ev2','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$snombdoc)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();

			$fechasev1=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','1')
			->where('idcct','=',$sicct)
			->get();

			$fechasev2=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','2')
			->where('idcct','=',$sicct)
			->get();
			return view('dashprofesores.exgrupoprof',compact('materia','idgru','horas'))->with('consulta',$consulta)->with('grupos',$grupos)->with('fechasev1',$fechasev1)->with('fechasev2',$fechasev2);
		}
	}

	public function extrasgrupo(Request $Request)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru');

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get(); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2','evaluaciones.extra1 as ex1','evaluaciones.extra2 as ex2','evaluaciones.extra3 as ex3','evaluaciones.extraesp as exp')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$snombdoc)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();

			$fechasex1=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e1')
			->where('idcct','=',$sicct)
			->get();

			$fechasex2=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e2')
			->where('idcct','=',$sicct)
			->get();

			$fechasex3=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e3')
			->where('idcct','=',$sicct)
			->get();

			$fechasexp=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','ep')
			->where('idcct','=',$sicct)
			->get();

			//echo $fechasex1;
			return view('dashprofesores.extrasprof',compact('materia','idgru','horas','fechasex1','fechasex2','fechasex3','fechasexp'))
			->with('consulta',$consulta)
			->with('grupos',$grupos);
		}
	}

	public function extrasgrupoget($idgru,$materia)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get(); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2','evaluaciones.extra1 as ex1','evaluaciones.extra2 as ex2','evaluaciones.extra3 as ex3','evaluaciones.extraesp as exp')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$snombdoc)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			$fechasex1=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e1')
			->where('idcct','=',$sicct)
			->get();

			$fechasex2=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e2')
			->where('idcct','=',$sicct)
			->get();

			$fechasex3=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','e3')
			->where('idcct','=',$sicct)
			->get();

			$fechasexesp=\DB::table('fechasev')
			->select('fecha_inicio','fecha_fin')
			->where('periodo','=','ep')
			->where('idcct','=',$sicct)
			->get();
			return view('dashprofesores.extrasprof',compact('materia','idgru','horas'))->with('consulta',$consulta)->with('grupos',$grupos)->with('$fex1',$fechasex1)->with('$fechasex2',$fechasex2)->with('$fechasex3',$fechasex3)->with('$fechasexesp',$fechasexesp);
		}
	}


	public function guardacalifextra(Request $Request)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

    		$datoss=$Request->all(); //RECIBE EL ARRAY DE DATOS DE LA VISTA
    		$datosss=$Request->input('idev'); //ARRAY REGISTROS (ALUMNOS) HAY EN EL GRUPO
    		$cdatos=count($datosss); //CUENTA EL ARRAY DE REGISTROS

    		for($i=0; $i < $cdatos; $i++) // RECIBE EL TOTAL DE LA CUENTA DE REGISTROS Y GENERA UN CICLO PARA ALMACENAR VALIDACIONES
    		{
    			$idev=$Request->input("idev.$i");
    			$ex1=$Request->input("ex1.$i");
    			$ex2=$Request->input("ex2.$i");
    			$ex3=$Request->input("ex3.$i");
    			$exp=$Request->input("exp.$i");
    				DB::table('evaluaciones')
					->where('idev',$idev)
					->update(['extra1'=>$ex1,'extra2'=>$ex2,'extra3'=>$ex3,'extraesp'=>$exp]);
    		}
    		
    		//echo "DATOS GUARDADOS";
    		Session::flash('msage','Calificaciones EXTRAORDINARIAS Guardadas con Exito');
			//return view('dashboard.exgrupoadm',compact('nombre','materia'))->with('grupos',$grupos)->with('consulta',$consulta);
			return redirect()->route('extrasgg',array('idgru'=>$idgru,'materia'=>$materia));
		}
	}

	public function guardacalif(Request $Request) // FUNCION QUE SE ENCARGA DE RECORRER EL ARRAY DE DATOS ENVIADO POR LA VISTA, HACIENDO INSERCCION EN LOS CAMPOS ESPECIFICOS
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

    		$datoss=$Request->all(); //RECIBE EL ARRAY DE DATOS DE LA VISTA
    		$datosss=$Request->input('idev'); //ARRAY REGISTROS (ALUMNOS) HAY EN EL GRUPO
    		$cdatos=count($datosss); //CUENTA EL ARRAY DE REGISTROS

    		for($i=0; $i < $cdatos; $i++) // RECIBE EL TOTAL DE LA CUENTA DE REGISTROS Y GENERA UN CICLO PARA ALMACENAR VALIDACIONES
    		{
    			$idev=$Request->input("idev.$i");
    			$ev1=$Request->input("ev1.$i");
    			$ev2=$Request->input("ev2.$i");
    			$f1=$Request->input("f1.$i");
    			$f2=$Request->input("f2.$i");
    			$prom=($ev1+$ev2)/2;
    			$iprom=intval($prom);
    			if($iprom>='6.0')
    			{
    				$rprom=round($prom);
    				DB::table('evaluaciones')
					->where('idev',$idev)
					->update(['primeraev'=>$ev1,'segundaev'=>$ev2,'promedio'=>$rprom,'faltasev1'=>$f1,'faltasev2'=>$f2]);
    			}
    			else
    			{
    				$rprom=intval($prom);
    				DB::table('evaluaciones')
					->where('idev',$idev)
					->update(['primeraev'=>$ev1,'segundaev'=>$ev2,'promedio'=>$rprom,'faltasev1'=>$f1,'faltasev2'=>$f2]);
    			}

    			//echo "<br>Paso: ".$i."  IDEV: ".$idev."  Ev1: ".$ev1."  Ev2: ".$ev2."  Faltas1: ".$f1."  Faltas2: ".$f2;
    			
    		}
    		
    		//echo "DATOS GUARDADOS";
    		Session::flash('msage','Calificaciones Guardadas con Exito');
			//return view('dashboard.exgrupoadm',compact('nombre','materia'))->with('grupos',$grupos)->with('consulta',$consulta);
			return redirect()->route('exgroupsg',array('idgru'=>$idgru,'materia'=>$materia));
		}
	}

	//******INICIO MODIFICA CONTRASEÑA PROFESOR*******
	public function modpasspro($idd)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{

			$docentes=\DB::table('docentes')
			->select('idd','nomDoc','curp','pass')
			->where('idd','=',$idd)
			->get();
			//echo $direccion;

			$tc3=count($docentes);

			$iddoc=$idd;
			//return view('dashboard.exadmgrupo',compact("idgrupo","tc3"))->with('consulta',$consulta)->with('consulta2',$consulta2)->with('consulta3',$consulta3);
			return view('dashprofesores.modpasspro',compact("iddoc","tc3"))->with('docentes',$docentes);
		}
	}

	public function guardamodpro(Request $Request)
	{
		$siddoc=Session::get('sessioniddoc');
		$snombdoc=Session::get('sessionnombdoc');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddoc =='' or $snombdoc=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
						
			$idd=$Request->input('idd');
			$passd=$Request->input('pass');
			$curpd=$Request->input('curp');

			DB::table('docentes')
			->where('idd',$idd)
			->update(['pass'=>$passd],['curp'=>$curpd]);
			
			Session::flash('msage','Contraseña Modificada correctamente');
			return redirect()->route('index');
		}
	}

	// ***** FIN INTERFAZ PROFESOR *****
//*****************************************************************************************************************************************************************************************
//*****************************************************************************************************************************************************************************************
//*****************************************************************************************************************************************************************************************
//*****************************************************************************************************************************************************************************************
	// ***** INTERFAZ ADMINISTRATIVO *****
	public function indexdir()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.indexdir');
		}
	}

	//******INICIO MODIFICA CONTRASEÑA ADMIN*********

	public function modpassadm($iddir)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{

			$direccion=\DB::table('direcciones')
			->select('iddir','nomdir','curp','pass')
			->where('iddir','=',$iddir)
			->get();
			//echo $direccion;

			$tc3=count($direccion);

			$iddirec=$iddir;
			//return view('dashboard.exadmgrupo',compact("idgrupo","tc3"))->with('consulta',$consulta)->with('consulta2',$consulta2)->with('consulta3',$consulta3);
			return view('dashboard.modpassadm',compact("iddirec","tc3"))->with('direccion',$direccion);
		}
	}

	public function guardamodadm (Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
						
			$iddir=$Request->input('iddir');
			$pass=$Request->input('pass');
			$curp=$Request->input('curp');
			

			DB::table('direcciones')
			->where('iddir',$iddir)
			->update(['pass'=>$pass],['curp'=>$curp]);
			
			Session::flash('msage','Contraseña Modificada correctamente');
			return redirect()->route('indexdir');
		}
	}
//****** FIN MODIFICA CONTRASEÑA ADMIN************

	public function buscaprof()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$consulta = \DB::table('docentes')
			->join('ccts','ccts.idcct','=','docentes.idcct')
			->select('docentes.nomDoc as nombre','docentes.idd as iddoc')
			->where('docentes.idcct',$sicct)
			->get();
			//$x=$consulta[0]->idt;
			//echo $consulta;
			return view('dashboard.buscaprof')->with('consulta',$consulta);
			//echo $sicct;
		}
	}

	public function altaprof()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.altaprof');
		}
	}

	public function guardaprof(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			/*$this->validate($Request,[
			'app'=>'required|alpha',
			'apm'=>'required|alpha',
			'nom'=>'required|alpha',
			'curp'=>'required|regex:/^[A-Z]{4}[0-9]{2}[0-9]{6}[A-Z]{6}[0-9]{2}$/'
			]);*/
			$idcct=$Request->input('idcct');
			$app=$Request->input('app');
			$apm=$Request->input('apm');
			$nom=$Request->input('nom');
			$curp=$Request->input('curp');
			$activo=$Request->input('activo');

			$nombre=$app.' '.$apm.' '.$nom;
			DB::Insert('insert into docentes(idcct,nomDoc,curp,activo) 
								values (?,?,?,?)',[$idcct,$nombre,$curp,$activo]);
			//echo $idcct.' '.$app.' '.$apm.' '.$nom.' '.$curp;
			Session::flash('msage','Profesor registrado correctamente');
			return redirect()->route('bprof');
		}
	}
	
	public function regmatprof(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			//echo $nombre;
			$prof= \DB::table('docentes')
			->select('idd','nomDoc')
			->where('nomDoc','like',$nombre)
			->get();
			$materias= \DB::table('materias')
			->select('idm','nommat','semestre')
			->get();
			//echo "Aqui se imprimen las materias y el profesor";
			return view('dashboard.rmatprof',compact('$nombre'))->with('prof',$prof)->with('materias',$materias);
		}
	}

	public function gregmatprof(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$prof=$Request->input('id');
			$mat=$Request->input('mat');
			$horas=$Request->input('horas');
			
			DB::Insert('insert into asigmat(idd,idm,horas) 
					values (?,?,?)',[$prof,$mat,$horas]);
			Session::flash('msage','MATERIA ASIGNADA!');
			return redirect()->route('groupsadmg',array('prof'=>$prof));
		}
	}

	public function gengrupo()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			//echo "ola ke ase? jenerando jrupos o ke ase?";
			$ciclos= \DB::table('ciclos')
			->select('ciclo')
			->get();
			return view('dashboard.gengrupo')->with('ciclos',$ciclos);
		}
	}

	public function guardagrupo(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$cct=$Request->input('idcct');
			$grado=$Request->input('grado');
			$grupo=$Request->input('grupo');
			$ciclo=$Request->input('ciclo');
			DB::Insert('insert into grupos(idcct,grado,grupo,cicloesc) 
					values (?,?,?,?)',[$cct,$grado,$grupo,$ciclo]);
			Session::flash('msage','Grupo almacenado correctamente');
			return redirect()->route('ggrupo');
			//echo "Datos enviados xD<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> no es cierto xDDDD";
			//echo $cct.' '.$grado.' '.$grupo.' '.$ciclo;

		}
	}

	public function admingrupo()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$grupos= \DB::table('grupos')
			->join('ccts','ccts.idcct','=','grupos.idcct')
			->select('idgru','grado','grupo','cicloesc')
			->where('ccts.idcct',$sicct)
			->distinct()
			->get();

			return view('dashboard.adgrupos')->with('grupos',$grupos);
			//echo $grupos;
			//echo "ola ke ase? adminitrando jrupos o ke ase?";
		}
	}

	public function exadmgrupo($idgru,$semestre)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$consulta= \DB::table('asiggru')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->select('alumnos.idal as idal','alumnos.nomalu as nomalu','alumnos.activo as activo','alumnos.sexo as sexo')
			->where('asiggru.idgru',$idgru)
			->get();
			$consulta2=\DB::table('asiggru')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->select('grupos.grado as grado','grupos.grupo as grupo')
			->where('asiggru.idgru',$idgru)
			->groupBy('asiggru.idgru')
			->get();
			$consulta3=\DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('materias','materias.idm','=','asigmat.idm')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->select('materias.nommat as materia','materias.idm as idm','docentes.nomDoc as nombre','asigmat.idam as idam')
			->where('asiggru.idgru',$idgru)
			->where('materias.semestre',$semestre)
			->distinct()
			->get();

			$tc3=count($consulta);

			$idgrupo=$idgru;
			return view('dashboard.exadmgrupo',compact("idgrupo","tc3","semestre"))->with('consulta',$consulta)->with('consulta2',$consulta2)->with('consulta3',$consulta3);
		}
	}

	public function asigmatgrupo($idgru, $semestre)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$materias=\DB::table('materias')
			->select('idm','nommat')
			->where('semestre',$semestre)
			->get();
			$sem=$semestre;
			$idg=$idgru;
			//echo $idg;
			return view('dashboard.selectmateria',compact('semestre','idg'))->with('materias',$materias);

		}
	}

	public function selectprofmat(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idgru=$Request->input('idgru');
			$semestre=$Request->input('semestre');
			$idm=$Request->input('idm');
			//echo $idgru.' '.$semestre.' '.$idm;
			$materia=\DB::table('materias')
			->select('nommat')
			->where('idm',$idm)
			->get();

			$profesores=\DB::table('asigmat')
			->join('materias','materias.idm','=','asigmat.idm')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->select('asigmat.idam','docentes.nomDoc as nombre')
			->where('materias.idm',$idm)
			->get();
			//echo $profesores;
			return view('dashboard.selectprofmat',compact('semestre','idgru','idm','materia'))->with('profesores',$profesores);

		}
	} 

	public function guardaprofmat(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idgru=$Request->input('idgru');
			$semestre=$Request->input('semestre');
			$idm=$Request->input('idm');
			$idam=$Request->input('idam');
			//echo $idgru.' '.$semestre.' '.$idm.' '.$idam.' aqui deberia de guardar :v';

			$registros=\DB::table('asiggru')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->select('asiggru.idag')
			->where('idgru',$idgru)
			->get();
			//echo $registros;
			$totalreg=count($registros);

			//$x =$registros[0]->idag;
			//echo $x;
			//echo $totalreg;
			$datos=array();
			for ($i=0; $i < $totalreg; $i++)
				{
					$datos[$i] = array ("idag"=>$registros[$i]->idag, "idam"=>$idam);
    			}
    		foreach($datos as $dato)
    		{
    			echo "<br>idag: ".$dato["idag"]."<br> idam: ".$dato["idam"];
    			DB::Insert('insert into evaluaciones(idag,idam) 
					values (?,?)',[$dato["idag"],$dato["idam"]]);
    		}
    		Session::flash('msage','MATERIA ASIGNADA CORRECTAMENTE AL GRUPO');
    		return redirect()->route('exadgru',array('idgru'=>$idgru,'semestre'=>$semestre));
		}
	}

	public function cambiaprofmat($idgru,$idam,$materia,$semestre,$idm)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$profact=\DB::table('evaluaciones')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('asigmat.idam as idam','docentes.nomdoc as nomdoc')
			->where('asigmat.idam',$idam)
			->distinct()
			->get();

			$profsel=\DB::table('asigmat')
			->join('materias','materias.idm','=','asigmat.idm')
				->join('docentes','docentes.idd','=','asigmat.idd')
				->select('asigmat.idam','docentes.nomDoc as nombre')
				->where('materias.idm',$idm)
				->where('asigmat.idam','!=',$idam)
				->get();
			return view('dashboard.cambiaprofmat',compact('idgru','idam','materia','semestre','idm'))->with('profact',$profact)->with('profsel',$profsel);
		}
	}

	public function guardamodprofmat(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idgru=$Request->input('idgru');
			$semestre=$Request->input('semestre');
			$idm=$Request->input('idm');
			$idamm=$Request->input('idam');
			$oldidam=$Request->input('oldidam');

			$gruact=\DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->select('evaluaciones.idev as idev','evaluaciones.idag as idag','evaluaciones.idam as idam')
			->where('asiggru.idgru','=',$idgru)
			->where('evaluaciones.idam','=',$oldidam)
			->get();

			$totalreg=count($gruact);


			for ($i=0; $i < $totalreg; $i++)
				{
				DB::table('evaluaciones')
				->where('idev',$gruact[$i]->idev)
				->update(['idam'=>$idamm]);
    			}

    		Session::flash('msage','MATERIA REASIGNADA CORRECTAMENTE AL GRUPO');
    		return redirect()->route('exadgru',array('idgru'=>$idgru,'semestre'=>$semestre));
		}
	}

	public function pregdelprof($idgru,$idam,$prof,$materia,$semestre,$idm)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.pregdelprof',compact('idgru','idam','prof','materia','semestre','idm'));
		}
	}

	public function delprof($idgru,$idam,$idm,$semestre)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$gruact=\DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->select('evaluaciones.idev as idev','evaluaciones.idag as idag','evaluaciones.idam as idam')
			->where('asiggru.idgru','=',$idgru)
			->where('evaluaciones.idam','=',$idam)
			->get();

			$totalreg=count($gruact);

			for ($i=0; $i < $totalreg; $i++)
				{
				DB::table('evaluaciones')
				->where('idev',$gruact[$i]->idev)
				->delete();
    			}
    		Session::flash('msage','PROFESOR ELIMINADO CORRECTAMENTE');
    		return redirect()->route('exadgru',array('idgru'=>$idgru,'semestre'=>$semestre));
		}
	}

	public function groupsadm(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$prof=$Request->input('prof');
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('docentes.nomDoc as nombre','docentes.idd as iddoc','grupos.grado as grado','grupos.grupo as grupo','materias.nommat as materia','materias.semestre as semestre','asiggru.idgru as idgru')
			->distinct()
			->where('docentes.idd',$prof)
			->get();
			$consulta2 = \DB::table('docentes')
			->select('idd as iddoc','nomDoc as nomprof')
			->where('idd',$prof)
			->get();
			$consulta3 = \DB::table('asigmat')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('asigmat.idam as idam','materias.nommat as nmateria','materias.semestre as semestre')
			->where('docentes.idd',$prof)
			->get();
;
			return view('dashboard.gruposadm')->with('consulta',$consulta)->with('consulta2',$consulta2)->with('consulta3',$consulta3);
		}
	}

	public function groupsadmget($prof)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			//$prof=$Request->input('prof');
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('docentes.nomDoc as nombre','docentes.idd as iddoc','grupos.grado as grado','grupos.grupo as grupo','materias.nommat as materia','materias.semestre as semestre','asiggru.idgru as idgru')
			->distinct()
			->where('docentes.idd',$prof)
			->get();
			$consulta2 = \DB::table('docentes')
			->select('idd as iddoc','nomDoc as nomprof')
			->where('idd',$prof)
			->get();
			$consulta3 = \DB::table('asigmat')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('asigmat.idam as idam','materias.nommat as nmateria','materias.semestre as semestre')
			->where('docentes.idd',$prof)
			->get();
			//$x=$consulta[0]->idt;
			//echo $consulta3;
			return view('dashboard.gruposadm')->with('consulta',$consulta)->with('consulta2',$consulta2)->with('consulta3',$consulta3);
			//echo $consulta;
		}
	}

	public function exgroupadm(Request $Request) //PRIMERA CONSULTA QUE MANDA DATOS A LA VISTA DONDE SE APRUEBAN LAS CALIFICACIONES Y LAS FALTAS
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 


			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();
			//DB::statement(DB::raw('SET @rownum = 0')); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.primeraev as ev1','evaluaciones.aprobacion1 as ap1','evaluaciones.segundaev as ev2','evaluaciones.aprobacion2 as ap2','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.aprof1 as af1','evaluaciones.faltasev2 as f2','evaluaciones.aprof2 as af2')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			//echo $grupos;
			return view('dashboard.exgrupoadm',compact('nombre','materia','horas'))->with('grupos',$grupos)->with('consulta',$consulta);
		}
	}

	public function exgroupadmget($idgru,$nombre,$materia) //RETORNO A LA VISTA QUE MANDA DATOS A LA VISTA DONDE SE APRUEBAN LAS CALIFICACIONES Y LAS FALTAS
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();
			//DB::statement(DB::raw('SET @rownum = 0')); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.primeraev as ev1','evaluaciones.aprobacion1 as ap1','evaluaciones.segundaev as ev2','evaluaciones.aprobacion2 as ap2','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.aprof1 as af1','evaluaciones.faltasev2 as f2','evaluaciones.aprof2 as af2')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();

			//echo $grupos;
			return view('dashboard.exgrupoadm',compact('nombre','materia','horas'))->with('grupos',$grupos)->with('consulta',$consulta);
		}
	}

	public function extrasgrupoadm(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 


			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();
			//DB::statement(DB::raw('SET @rownum = 0')); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2','evaluaciones.extra1 as ex1','evaluaciones.apextra1 as aex1','evaluaciones.extra2 as ex2','evaluaciones.apextra2 as aex2','evaluaciones.extra3 as ex3','evaluaciones.apextra3 as aex3','evaluaciones.extraesp as exp','evaluaciones.apextraesp as aexp')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			//echo $grupos;
			return view('dashboard.extrasgrupo',compact('nombre','materia','horas'))->with('grupos',$grupos)->with('consulta',$consulta);
		}
	}

	public function extrasgrupoadmget($idgru,$nombre,$materia)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();
			//DB::statement(DB::raw('SET @rownum = 0')); 
			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2','evaluaciones.extra1 as ex1','evaluaciones.apextra1 as aex1','evaluaciones.extra2 as ex2','evaluaciones.apextra2 as aex2','evaluaciones.extra3 as ex3','evaluaciones.apextra3 as aex3','evaluaciones.extraesp as exp','evaluaciones.apextraesp as aexp')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			//echo $grupos;
			return view('dashboard.extrasgrupo',compact('nombre','materia','horas'))->with('grupos',$grupos)->with('consulta',$consulta);
		}
	}

	public function guardaaprobex(Request $Request) // FUNCION QUE SE ENCARGA DE RECORRER EL ARRAY DE DATOS ENVIADO POR LA VISTA, HACIENDO INSERCCION EN LOS CAMPOS ESPECIFICOS
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

    		$datoss=$Request->all(); //RECIBE EL ARRAY DE DATOS DE LA VISTA
    		$datosss=$Request->input('idev'); //ARRAY REGISTROS (ALUMNOS) HAY EN EL GRUPO
    		$cdatos=count($datosss); //CUENTA EL ARRAY DE REGISTROS

    		for($i=0; $i < $cdatos; $i++) // RECIBE EL TOTAL DE LA CUENTA DE REGISTROS Y GENERA UN CICLO PARA ALMACENAR VALIDACIONES
    		{
    			$idev=$Request->input("idev.$i");
    			$aex1=$Request->input("aex1.$i");
    			$aex2=$Request->input("aex2.$i");
    			$aex3=$Request->input("aex3.$i");
    			$aexp=$Request->input("aexp.$i");

    			//echo "<br>Paso: ".$i."  IDEV: ".$idev."  Aprov1: ".$aprov1."  Aprov2: ".$aprov2."  Faltas1: ".$af1."  Faltas2: ".$af2;
    			DB::table('evaluaciones')
				->where('idev',$idev)
				->update(['apextra1'=>$aex1,'apextra2'=>$aex2,'apextra3'=>$aex3,'apextraesp'=>$aexp]);
    		}
    		
    		echo "DATOS GUARDADOS";
    		Session::flash('msage','Validacion de calificaciones EXTRAORDINARIAS almacenada');
			//return view('dashboard.exgrupoadm',compact('nombre','materia'))->with('grupos',$grupos)->with('consulta',$consulta);
			return redirect()->route('egadmg',array('idgru'=>$idgru,'materia'=>$materia,'nombre'=>$nombre));
		}
	}

	public function guardaaprob(Request $Request) // FUNCION QUE SE ENCARGA DE RECORRER EL ARRAY DE DATOS ENVIADO POR LA VISTA, HACIENDO INSERCCION EN LOS CAMPOS ESPECIFICOS
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

    		$datoss=$Request->all(); //RECIBE EL ARRAY DE DATOS DE LA VISTA
    		$datosss=$Request->input('idev'); //ARRAY REGISTROS (ALUMNOS) HAY EN EL GRUPO
    		$cdatos=count($datosss); //CUENTA EL ARRAY DE REGISTROS

    		for($i=0; $i < $cdatos; $i++) // RECIBE EL TOTAL DE LA CUENTA DE REGISTROS Y GENERA UN CICLO PARA ALMACENAR VALIDACIONES
    		{
    			$idev=$Request->input("idev.$i");
    			$aprov1=$Request->input("aprov1.$i");
    			$aprov2=$Request->input("aprov2.$i");
    			$af1=$Request->input("af1.$i");
    			$af2=$Request->input("af2.$i");

    			//echo "<br>Paso: ".$i."  IDEV: ".$idev."  Aprov1: ".$aprov1."  Aprov2: ".$aprov2."  Faltas1: ".$af1."  Faltas2: ".$af2;
    			DB::table('evaluaciones')
				->where('idev',$idev)
				->update(['aprobacion1'=>$aprov1,'aprobacion2'=>$aprov2,'aprof1'=>$af1,'aprof2'=>$af2]);
    		}
    		
    		echo "DATOS GUARDADOS";
    		Session::flash('msage','Validacion de calificaciones almacenada');
			//return view('dashboard.exgrupoadm',compact('nombre','materia'))->with('grupos',$grupos)->with('consulta',$consulta);
			return redirect()->route('exgroupadmg',array('idgru'=>$idgru,'materia'=>$materia,'nombre'=>$nombre));
		}
	}

	public function altaalumno()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$year=date("y");

			
			$idesc= \DB::table('ccts')
			->select('identificador')
			->where('idcct',$sicct)
			->get();
			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo','cicloesc')
			->get();
			//echo $year.'-'.$idesc;
			return view('dashboard.altaalumno',compact('year'))->with('identificador',$idesc)->with('grupos',$grupos);
			//echo "aqui va alumno";
		}
	}

	public function guardaalumno(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idcct=$Request->input('idcct');
			$app=$Request->input('app');
			$apm=$Request->input('apm');
			$nom=$Request->input('nom');
			$curp=$Request->input('curp');
			$activo=$Request->input('activo');
			$matricula=$Request->input('matricula');
			$sexo=$Request->input('sexo');
			$grupo=$Request->input('grupo');

			$nombre=$app.' '.$apm.' '.$nom;
			DB::Insert('insert into alumnos(idcct,matricula,nomalu,curp,activo,sexo) 
								values (?,?,?,?,?,?)',[$idcct,$matricula,$nombre,$curp,$activo,$sexo]);

			$otraconsulta=\DB::table('alumnos')
			->select('idal','nomalu')
			->where('nomalu','like',$nombre)
			->get();
			$xn=$otraconsulta[0]->idal;

			DB::insert('insert into asiggru (idal,idgru)
								values(?,?)',[$xn,$grupo]);
			//echo $idcct.' '.$app.' '.$apm.' '.$nom.' '.$curp;
			Session::flash('msage','Alumno registrado correctamente');
			return redirect()->route('aalumno');
		}
	}

	public function modifalumno($idal)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			//echo "modifica alumno";
			//echo "<br>".$idal;
			$datos=\DB::table('asiggru as ag')
			->join('alumnos as a','a.idal','=','ag.idal')
			->join('grupos as g','g.idgru','=','ag.idgru')
			->select('a.idal', 'a.matricula', 'a.curp', 'a.nomalu', 'a.activo', 'a.sexo', 'ag.idag', 'g.idgru', 'g.grado', 'g.grupo', 'g.cicloesc')
			->where('ag.idal',$idal)
			->get();

			$idgrupo=$datos[0]->idgru;

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo','cicloesc')
			->where('idgru','!=',$idgrupo)
			->get();

			return view('dashboard.modalu')->with('datos',$datos)->with('grupos',$grupos);
		}
	}

	public function guardamodalumno(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idcct=$Request->input('idcct');
			$idal=$Request->input('idal');
			$nom=$Request->input('nom');
			$curp=$Request->input('curp');
			$activo=$Request->input('activo');
			$matricula=$Request->input('matricula');
			$sexo=$Request->input('sexo');
			$grupo=$Request->input('grupo');

			DB::table('alumnos')
			->where('idal',$idal)
			->update(['matricula'=>$matricula],['curp'=>$curp],['nomalu'=>$nom],['sexo'=>$sexo],['activo'=>$activo]);

			DB::table('asiggru')
			->where('idal',$idal)
			->update(['idgru'=>$grupo]);
			Session::flash('msage','Alumno Modificado correctamente');
			return redirect()->route('adgrupo');
		}
	}

	/* REPORTE DE INCONSISTENCIAS POR MATERIA */

	public function repinconsistencias(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();

			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.primeraev as ev1','evaluaciones.aprobacion1 as ap1','evaluaciones.segundaev as ev2','evaluaciones.aprobacion2 as ap2','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.aprof1 as af1','evaluaciones.faltasev2 as f2','evaluaciones.aprof2 as af2')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			$cconsulta=count($consulta);
			$grado=$grupos[0]->grado;
			$grupo=$grupos[0]->grupo;
			$date = date('Y-m-d');
			$ggd=($grado.'-'.$grupo.'-'.$date);
			//echo $ggd;
			$view =  \View::make('pdfs.reportegrupo', compact('nombre', 'materia','cconsulta','horas'))->with('grupos',$grupos)->with('consulta',$consulta)->render();
        	$pdf = \App::make('dompdf.wrapper');
        	$pdf->loadHTML($view);
        	return $pdf->stream('reportegrupo'.$ggd.'.pdf');
		}
	}

	public function repincextras(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$materia=$Request->input('materia');
			$idgru=$Request->input('idgru'); 

			$grupos=\DB::table('grupos')
			->select('idgru','grado','grupo')
			->where('idgru',$idgru)
			->get();

			$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('alumnos','alumnos.idal','=','asiggru.idal')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select('evaluaciones.idev as idev','evaluaciones.idam as idam','alumnos.nomalu as nalu','evaluaciones.promedio as promedio','evaluaciones.faltasev1 as f1','evaluaciones.faltasev2 as f2','evaluaciones.extra1 as ex1','evaluaciones.apextra1 as aex1','evaluaciones.extra2 as ex2','evaluaciones.apextra2 as aex2','evaluaciones.extra3 as ex3','evaluaciones.apextra3 as aex3','evaluaciones.extraesp as exp','evaluaciones.apextraesp as aexp')
			->where('materias.nommat','like',$materia)
			->where('docentes.nomDoc','like',$nombre)
			->where('asiggru.idgru','=',$idgru)
			->get();

			$idamm=$consulta[0]->idam;
			//echo $idamm;	
			$horas=\DB::table('asigmat')
			->select('horas')
			->where('idam','=',$idamm)
			->get();
			$cconsulta=count($consulta);
			$grado=$grupos[0]->grado;
			$grupo=$grupos[0]->grupo;
			$date = date('Y-m-d');
			$ggd=($grado.'-'.$grupo.'-'.$date);
			//echo $ggd;
			$view =  \View::make('pdfs.reportegrupoex', compact('nombre', 'materia','cconsulta','horas'))->with('grupos',$grupos)->with('consulta',$consulta)->render();
        	$pdf = \App::make('dompdf.wrapper');
        	$pdf->loadHTML($view);
        	return $pdf->stream('reportegextras'.$ggd.'.pdf');
		}
	}

	public function evregular()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.fechasevregular');
		}
	}

	public function evaluacion_uno()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.fevprimera');
		}
	}

	public function guardafechafev(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','1')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}

	public function evaluacion_dos()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.fevsegunda');
		}
	}

	public function guardafechasev(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','2')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}

	public function evextra()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.fechasextra');
		}
	}

	public function extra_uno()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.extrauno');
		}
	}

	public function guardafechasex1(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','e1')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}


	public function extra_dos()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.extrados');
		}
	}

	public function guardafechasex2(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','e2')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}

	public function extra_tres()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.extratres');
		}
	}

	public function guardafechasex3(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','e3')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}

	public function extra_esp()
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			return view('dashboard.extraesp');
		}
	}

	public function guardafechasexesp(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$diain=$Request->input('diain');
			$mesin=$Request->input('mesin');
			$yearin=$Request->input('yearin');
			$diafin=$Request->input('diafin');
			$mesfin=$Request->input('mesfin');
			$yearfin=$Request->input('yearfin');
			//echo $diain."-".$mesin."-".$yearin."<br>".$diafin."-".$mesfin."-".$yearfin;
			$fechainicio=$yearin."-".$mesin."-".$diain;
			$fechafin=$yearfin."-".$mesfin."-".$diafin;
			DB::table('fechasev')
			->where('idcct','=',$sicct)
			->where('periodo','=','ep')
			->update(['fecha_inicio'=>$fechainicio,'fecha_fin'=>$fechafin]);
			Session::flash('msage','Fecha Agregada correctamente');
			return redirect()->route('indexdir');
		}
	}

	public function cambiahoras(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$nombre=$Request->input('nombre');
			$idam=$Request->input('idam');
			//echo $nombre;
			$prof= \DB::table('docentes')
			->select('idd','nomDoc')
			->where('nomDoc','like',$nombre)
			->get();
			$horas=\DB::table('asigmat')
			->select('idam','idd','horas')
			->where('idam','=',$idam)
			->get();
			//echo $idam;
			return view('dashboard.cambiahoras')->with('prof',$prof)->with('horas',$horas);
		}
	}

	public function guardahoras(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$idam=$Request->input('idam');
			$prof=$Request->input('idd');
			$horas=$Request->input('horas');

			DB::table('asigmat')
			->where('idam','=',$idam)
			->update(['horas'=>$horas]);
			Session::flash('msage','Horas Modificadas correctamente');
			return redirect()->route('groupsadmg',array('prof'=>$prof));
		}
	}

	public function pdfgeneralprof(Request $Request)
	{
		$siddire=Session::get('sessioniddire');
		$snombdir=Session::get('sessionnombdir');
		$sicct=Session::get('sessionicct');
		$scctnom=Session::get('sessioncctnom');
		$scctesc=Session::get('sessioncctesc');
		
		if($siddire =='' or $snombdir=='' or $scctnom =='' or $scctesc =='')
		{
			Session::flash('error','Es necesario loguearse antes de continuar');
			return redirect()->route('logccc');
		}
		else
		{
			$prof=$Request->input('prof');
			$nomprof=$Request->input('nomprof');
			/*$consulta = \DB::table('evaluaciones')
			->join('asiggru','asiggru.idag','=','evaluaciones.idag')
			->join('grupos','grupos.idgru','=','asiggru.idgru')
			->join('asigmat','asigmat.idam','=','evaluaciones.idam')
			->join('docentes','docentes.idd','=','asigmat.idd')
			->join('materias','materias.idm','=','asigmat.idm')
			->select(DB::raw('COUNT(evaluaciones.idev)/SUM(evaluaciones.promedio) as promgral'),'grupos.grado as grado','grupos.grupo as grupo','materias.nommat as materia')
			->groupBy('grupos.grado','grupos.grupo','materias.nommat')
			->where('docentes.idd',$prof)
			->get();*/

			//echo $consulta;

			$consulta=DB::Select("SELECT  SUM(`evaluaciones`.`promedio`)/COUNT(`evaluaciones`.`idev`) AS promgral, `grupos`.`grado` AS `grado`, `grupos`.`grupo` AS `grupo`, `materias`.`nommat` AS `materia` FROM `evaluaciones` INNER JOIN `asiggru` ON `asiggru`.`idag` = `evaluaciones`.`idag` INNER JOIN `grupos` ON `grupos`.`idgru` = `asiggru`.`idgru` INNER JOIN `asigmat` ON `asigmat`.`idam` = `evaluaciones`.`idam` INNER JOIN `docentes` ON `docentes`.`idd` = `asigmat`.`idd` INNER JOIN `materias` ON `materias`.`idm` = `asigmat`.`idm` WHERE `docentes`.`idd` = ? GROUP BY `grupos`.`grado`, `grupos`.`grupo`, `materias`.`nommat`",[$prof]);

			//$result=DB::Select('select * from principal where idp=?',[$idp]);
			//echo $consulta;
			

			$view = \View::make('pdfs.pdfpromedioprof',compact('nomprof','scctnom','scctesc'))->with("consulta",$consulta);
        	$pdf = \App::make('dompdf.wrapper');
        	$pdf->loadHTML($view);
        	return $pdf->stream('promedioprof.pdf');
		}
	}
}
