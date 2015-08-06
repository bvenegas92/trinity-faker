<?php

require __DIR__.'/vendor/autoload.php';

use Trinity\Faker\Entities\Carrera;
use Trinity\Faker\Entities\Asignatura;
use Trinity\Faker\Entities\Aula;
use Trinity\Faker\Entities\Horario;
use Trinity\Faker\Entities\Ciclo;
use Trinity\Faker\Entities\Alumno;
use Trinity\Faker\Entities\Grupo;
use Trinity\Faker\Entities\Clase;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'trinity',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

class Faker{

	public function generarCatalogos(){
		$this->publicarCarreras();
		$this->publicarAsignaturas();
		$this->publicarAulas();
		$this->publicarHorarios();
		$this->publicarAsignaturasPorCarrera();
	}

	public function generarNuevaGeneracion(){
		$ciclo = Ciclo::all();
		if($ciclo->count() > 0){
			$ultimo_cuatrimestre = Grupo::where('ciclo_id','=',$ciclo->last()->id)->max('cuatrimestre');
			for($i = $ultimo_cuatrimestre; $i <= 10; $i++){
				$this->generarNuevoCuatrimestre();
			}
		}
		else{
			for($i = 1; $i <= 10; $i++){
				$this->generarNuevoCuatrimestre();
			}
		}
	}

	public function generarNuevoCuatrimestre(){
		echo "\nGenerando cuatrimestre...";
		if(Ciclo::all()->count() > 0){
			$ciclo_anterior = Ciclo::all()->last();
			$this->publicarCalificaciones($ciclo_anterior->id);
		}

		$this->publicarCiclo();
		$ciclo_actual = Ciclo::all()->last();

		if(Ciclo::all()->count() > 1)
			$this->avanzarGrupos($ciclo_anterior->id, $ciclo_actual->id);
		
		if(preg_match("/SEP/", $ciclo_actual->nombre))
			$this->publicarGrupos($ciclo_actual->id);

		$this->publicarClases($ciclo_actual->id);
	}

	public function publicarCarreras(){
		echo "\nGenerando carreras...";
		Carrera::crearCarreras();
	}

	public function publicarAsignaturas(){
		echo "\nGenerando asignaturas...";
		Asignatura::crearAsignaturas();
	}

	public function publicarAulas(){
		echo "\nGenerando aulas...";
		Aula::crearAulas();
	}

	public function publicarHorarios(){
		echo "\nGenerando horarios...";
		Horario::crearHorarios();
	}

	public function publicarAsignaturasPorCarrera(){
		echo "\nRelacionando asignaturas con carreras...";
		Asignatura::relacionarAsignaturasConCarreras();
	}

	public function publicarCiclo(){
		echo "\nGenerando ciclo...";
		Ciclo::crearCiclo();
	}

	public function publicarGrupos($ciclo_id, $cuatrimestre = 1){
		echo "\nGenerando grupos...";
		foreach (Carrera::all() as $carrera) {
			for($i = 1; $i <= 3; $i++){
				$grupo = Grupo::crearGrupo($carrera->clave.' 1-'.$i, $carrera->id, $ciclo_id, $cuatrimestre);
			}
		}
	}

	public function publicarClases($ciclo_id){
		echo "\nGenerando clases...";
		$ciclo = Ciclo::find($ciclo_id);
		$grupos = Grupo::where('ciclo_id','=',$ciclo->id)
						->get();
		foreach ($grupos as $grupo) {
			Clase::crearClases($grupo->id, $ciclo_id);
		}
	}

	public function publicarCalificaciones($ciclo_id){
		echo "\nGenerando calificaciones...";
		$ciclo = Ciclo::find($ciclo_id);
		$grupos = Grupo::where('ciclo_id','=',$ciclo->id)
						->get();
		foreach ($grupos as $grupo) {
			$asignaturas = Asignatura::with(array('carreras' => function($q) use ($grupo){
									$q->where('carrera_id','=',$grupo->carrera_id);
								}))
								->whereHas('carreras', function($q) use ($grupo){
									$q->where('carrera_id','=',$grupo->carrera_id)
										->where('cuatrimestre','=',$grupo->cuatrimestre);
								})
								->get();
			$alumnos = Alumno::whereHas('grupos', function($q) use ($grupo){
									$q->where('grupo_id','=',$grupo->id);
								})
								->get();
			foreach ($alumnos as $alumno) {
				foreach ($asignaturas as $asignatura) {
					$corte_1 = min(10, rand(7,10)+(rand(0,9)/10));
					$corte_2 = min(10, rand(7,10)+(rand(0,9)/10));
					$corte_3 = min(10, rand(7,10)+(rand(0,9)/10));
					$alumno->calificaciones()->attach($asignatura->id, array('corte_1' => $corte_1, 'corte_2' => $corte_2, 'corte_3' => $corte_3));
				}
			}
		}
	}

	public function avanzarGrupos($ciclo_anterior_id, $ciclo_actual_id){
		echo "\nAvanzando grupos...";
		$grupos = Grupo::where('ciclo_id','=',$ciclo_anterior_id)
							->where('cuatrimestre','<',10)
							->get();
		foreach ($grupos as $grupo) {
			$grupo->avanzarCiclo($ciclo_actual_id);
		}
	}
}

$faker = new Faker;

/****************************************************/
/***************     ADVERTENCIA     ****************/
/****  PUEDE DURAR VARIOS MINUTOS INCLUSO HORAS  ****/
/****  DEPENDIENDO DE LA CANTIDAD DE INFORMACION  ***/
/****************************************************/


/******************   CATALOGOS   *******************/
$faker->generarCatalogos();

/**********   GENERAR NUEVO CUATRIMESTRE   **********/
$faker->generarNuevoCuatrimestre();

/**********   GENERAR NUEVAS GENERACIONES   *********/
//$faker->generarNuevaGeneracion();