<?php

Route::get('/', function () {
    return view('welcome');
});

// *** LOGIN **************************************************************************************************************************************

Route::get('/logincc','login@logincc')->name('logcc');

Route::get('/loginccc','login@loginccc')->name('logccc');

Route::post('/valida','login@valida')->name('valida');

Route::get('/cerrarsesion','login@cerrarsesion')->name('cerrarsesion');

Route::get('/cerrarsesiondir','login@cerrarsesiondir')->name('cerrarsesiondir');

// *** INTERFACES *********************************************************************************************************************************

//*** INTERFAZ DE ADMINISTRATIVO*******************************************************************************************************************

Route::get('/indexdir','calif@indexdir')->name('indexdir'); //Pagina inicial del Administrativo de la escuela

/* ALISSON */Route::get('/mpassadm/{iddir}','calif@modpassadm')->name('mpadm'); // Modifica la contraseña del usuario admin logueado

/* ALISSON */Route::post('/gmodadm','calif@guardamodadm')->name('gmodifadm'); //guarda modificacion de admin logueado

Route::get('/mpassadm/{iddir}','calif@modpassadm')->name('mpadm'); // Modifica la contraseña del usuario admin logueado

Route::get('/bprof','calif@buscaprof')->name('bprof'); //Pantalla de busqueda de profesor

Route::get('/aprof','calif@altaprof')->name('aprof'); //Formulario para alta de profesor en la institucion

Route::post('/gprog','calif@guardaprof')->name('gprof'); //Guarda nuevo profesor generado

Route::post('/rmprof','calif@regmatprof')->name('rmprof'); //Selector de materias para adjuntarlas con el profesor

Route::post('/grmprof','calif@gregmatprof')->name('grmprof'); //guarda la materia asignada al profesor

Route::get('/ggrupo','calif@gengrupo')->name('ggrupo'); // Genera formulario para alta de nuevo grupo

Route::post('/guardagrupo','calif@guardagrupo')->name('gdgrupo'); //Guarda el nuevo grupo generado

Route::get('/adgrupo','calif@admingrupo')->name('adgrupo'); //Administra un grupo nuevo ** AUN EN PROCESO

Route::get('/exadgru/{idgru}/{semestre}','calif@exadmgrupo')->name('exadgru'); //Muestra toda la informacion del grupo seleccionado

Route::post('/guardaaprobacion','calif@guardaaprob')->name('gaprob'); //guarda los checks de calificaciones y faltas en la base de datos

Route::post('/guardaapex','calif@guardaaprobex')->name('gaprobex'); //guarda los checks de calificaciones y faltas en la base de datos

Route::get('/asmatgrupo/{idgru}/{semestre}','calif@asigmatgrupo')->name('amgrupo'); //selecciona materia para grupo

Route::post('/smprof','calif@selectprofmat')->name('selectprofmat'); // selecciona profesor para impartir la materia

Route::post('/gpmat','calif@guardaprofmat')->name('gpmat'); //guarda al profesor que impartira la materia seleccionada

Route::get('/cmprof/{idgru}/{idam}/{materia}/{semestre}/{idm}','calif@cambiaprofmat')->name('cmprof');

Route::post('/gmprofmat','calif@guardamodprofmat')->name('gpmodmat');

Route::get('/preguntadel/{idgru}/{idam}/{prof}/{materia}/{semestre}/{idm}','calif@pregdelprof')->name('pgdel');

Route::get('/delprof/{idgru}/{idam}/{idm}/{semestre}','calif@delprof')->name('delprof');

Route::post('/groupsadm','calif@groupsadm')->name('groupsadm'); //MUestra los grupos a cargo de un profesor ademas de las materias que tiene asignadas

Route::get('/groupsadmg/{prof}','calif@groupsadmget')->name('groupsadmg'); //Ruta recepcion del registro de materias, su funcion es la misma que la ruta de arriba ↑↑↑↑↑↑↑↑

/* Esta */Route::post('/exgroupadm','calif@exgroupadm')->name('exgroupadm');//muestra a detalle los grupos por materias y calificaciones, ademas de fungir como formulario de aprobacion de calificaciones

/* y Esta */Route::get('/exgroupadmg/{idgru}/{nombre}/{materia}','calif@exgroupadmget')->name('exgroupadmg');//Lo mismo que la anterior pero con GET

Route::post('/extrasgadm','calif@extrasgrupoadm')->name('egadm');

Route::get('/extrasgadmg/{idgru}/{nombre}/{materia}','calif@extrasgrupoadmget')->name('egadmg');

Route::get('/altaalumno','calif@altaalumno')->name('aalumno'); // formulario de alta para alumnos

Route::post('/galumno','calif@guardaalumno')->name('galumno'); //Guarda el nuevo alumno

Route::get('/modalumno/{idal}','calif@modifalumno')->name('malumno');

Route::post('/gmodalumno','calif@guardamodalumno')->name('gmalumno');

Route::get('/evaluacionr','calif@evregular')->name('evreg');

Route::get('/firstev','calif@evaluacion_uno')->name('fev');

Route::post('/gfechafev','calif@guardafechafev')->name('gfev');

Route::get('/secondev','calif@evaluacion_dos')->name('sev');

Route::post('/gfechasev','calif@guardafechasev')->name('gsev');

Route::get('/evaluacionex','calif@evextra')->name('evex');

Route::get('/ext1','calif@extra_uno')->name('ext1');

Route::post('/gfex1','calif@guardafechasex1')->name('gfex1');

Route::get('/ext2','calif@extra_dos')->name('ext2');

Route::post('/gfex2','calif@guardafechasex2')->name('gfex2');

Route::get('/ext3','calif@extra_tres')->name('ext3');

Route::post('/gfex3','calif@guardafechasex3')->name('gfex3');

Route::get('/extesp','calif@extra_esp')->name('extesp');

Route::post('/gfexesp','calif@guardafechasexesp')->name('gfexesp');

Route::post('/cambiahoras','calif@cambiahoras')->name('cambiahoras');

Route::post('/guardahoras','calif@guardahoras')->name('guardahoras');

//Route::get('/genpdf','calif@generarpdf')->name('gpdf');

/* REPORTESSSSSSS xDD */

Route::post('/rinconsitencias','calif@repinconsistencias')->name('repinc');

Route::post('/rinconsitenciasex','calif@repincextras')->name('repincex');

Route::post('/reportepromediogral','calif@pdfgeneralprof')->name('pdfgp');

//*** INTERFAZ DE PROFESORES**************************************************************************************************************************

Route::get('/index','calif@index')->name('index'); //Pagina principal del Profesor

/* ALISSON */Route::get('/mpasspro/{idd}','calif@modpasspro')->name('mppro'); // Modifica la contraseña del usuario admin logueado

/* ALISSON */Route::post('/gmodpro','calif@guardamodpro')->name('gmodifpro'); //guarda modificacion de admin logueado

Route::get('/grupos','calif@groups')->name('grupos');

Route::post('/exgroups','calif@exgroup')->name('exgroups');

Route::get('/exgroupsg/{idgru}/{materia}','calif@exgroupget')->name('exgroupsg'); 

Route::post('/extrasg','calif@extrasgrupo')->name('extrasg');

Route::get('/extrasgget/{idgru}/{materia}','calif@extrasgrupoget')->name('extrasgg');

Route::post('/guardacalificacion','calif@guardacalif')->name('gcalif'); //guarda calificaciones

Route::post('/gcalifex','calif@guardacalifextra')->name('gcalifex'); //guarda calificaciones extraordinarias

//**** OTRAS VAINAS QUE NO SE QUE ONDA XD *************************************************************************************************************

//Route::get('/download/{file}', 'calif@downloadFile');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
