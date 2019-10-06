<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

class login extends Controller
{
   public function logincc()
	{
		return view('login.index1');
	}

	public function loginccc()
	{
		return view('login.index2');
	}

	public function valida(Request $Request)
	{
		$selection=$Request->input('selection');
		$curp=$Request->input('curp');
		$pass=$Request->input('pass');
		if($selection=="prof")
		{
			$consulta= \DB::table('docentes')
			->join('ccts','docentes.idcct','=','ccts.idcct')
			->select('docentes.idd as iddoc','docentes.nomDoc as nombdoc','ccts.idcct as idcct','ccts.nomEsc as cctnom', 'ccts.cct as cctesc')
			->where('docentes.curp','=',$curp)
			->get();
			//echo count($consulta);
			//dd($Request->all());
			if(count($consulta)==0)
			{
				Session::flash('error','La CURP ingresada o la seleccion de personal no es correcta o no existe');
				return view('login.index2');
			}
			else
			{
				Session::put('sessioniddoc',$consulta[0]->iddoc);
				Session::put('sessionnombdoc',$consulta[0]->nombdoc);
				Session::put('sessionicct',$consulta[0]->idcct);
				Session::put('sessioncctnom',$consulta[0]->cctnom);
				Session::put('sessioncctesc',$consulta[0]->cctesc);
				
				$siddoc=Session::get('sessioniddoc');
				$snombdoc=Session::get('sessionnombdoc');
				$sicct=Session::get('sessionicct');
				$scctnom=Session::get('sessioncctnom');
				$scctesc=Session::get('sessioncctesc');
				//echo $siddoc. ' ' . $snombdoc. ' ' . $scctnom.' '.$scctesc; 
				return redirect()->route('index');
			}
		}
		else
		{
			$consulta= \DB::table('direcciones')
			->join('ccts','direcciones.idcct','=','ccts.idcct')
			->select('direcciones.iddir as iddire','direcciones.nomdir as nombdir', 'direcciones.idcct as icct','ccts.nomEsc as cctnom','ccts.cct as cctesc')
			->where('direcciones.curp','=',$curp)
			->where('direcciones.pass','=',$pass)
			->get();
			//echo count($consulta);
			//dd($Request->all());
			if(count($consulta)==0)
			{
				Session::flash('error','La CURP ingresada o la seleccion de personal no es correcta o no existe');
				return view('login.index2');
			}
			else
			{
				Session::put('sessioniddire',$consulta[0]->iddire);
				Session::put('sessionnombdir',$consulta[0]->nombdir);
				Session::put('sessionicct',$consulta[0]->icct);
				Session::put('sessioncctnom',$consulta[0]->cctnom);
				Session::put('sessioncctesc',$consulta[0]->cctesc);
				
				$siddire=Session::get('sessioniddire');
				$snombdir=Session::get('sessionnombdir');
				$sicct=Session::get('sessionicct');
				$scctnom=Session::get('sessioncctnom');
				$scctesc=Session::get('sessioncctesc');

				//echo $siddire. ' ' . $snombdir . ' ' . $scctnom. ' ' .$scctesc; 
				return redirect()->route('indexdir');
			}
		}
	}
	
	public function cerrarsesion()
	{
		Session::forget('sessioniddoc');
		Session::forget('sessionnombdoc');
		Session::forget('sessionicct');
		Session::forget('sessioncctnom');
		Session::forget('sessioncctesc');
		Session::flush();
		Session::flash('error','Sesion Cerrada Correctamente');
		return redirect()->route('logccc');
	}

	public function cerrarsesiondir()
	{
		Session::forget('sessioniddire');
		Session::forget('sessionnombdir');
		Session::forget('sessionicct');
		Session::forget('sessioncctnom');
		Session::forget('sessioncctesc');
		Session::flush();
		Session::flash('error','Sesion Cerrada Correctamente');
		return redirect()->route('logccc');
	}
}
