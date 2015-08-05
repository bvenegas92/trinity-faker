<?php

require __DIR__.'/vendor/autoload.php';

use Trinity\Faker\Entities\Carrera;
use Trinity\Faker\Entities\Asignatura;
use Trinity\Faker\Entities\Aula;
use Trinity\Faker\Entities\Horario;
use Trinity\Faker\Entities\Ciclo;
use Trinity\Faker\Entities\Grupo;
use Trinity\Faker\Entities\Clase;
use Trinity\Faker\Generators\AsignaturasGenerator;
use Trinity\Faker\Generators\AlumnosGenerator;
use Trinity\Faker\Generators\CiclosGenerator;
use Trinity\Faker\Generators\ProfesoresGenerator;
use Trinity\Faker\Generators\GruposGenerator;
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

	public function generarNuevoCuatrimestre(){
		$this->publicarCiclo();
		$this->publicarGruposNuevoIngreso();
		$this->publicarClases();
	}

	/*********************************/
	public function publicarCarreras(){
		Carrera::crearCarreras();
	}

	public function publicarAsignaturas(){
		Asignatura::crearAsignaturas();
	}

	public function publicarAulas(){
		Aula::crearAulas();
	}

	public function publicarHorarios(){
		Horario::crearHorarios();
	}

	public function publicarAsignaturasPorCarrera(){
		Asignatura::relacionarAsignaturasConCarreras();
	}

	public function publicarCiclo(){
		Ciclo::crearCiclo();
	}

	public function publicarGruposNuevoIngreso(){
		foreach (Carrera::all() as $carrera) {
			for($i = 1; $i <= 3; $i++){
				$grupo = Grupo::crearGrupo($carrera->clave.' 1-'.$i, $carrera->id);
			}
		}
	}

	public function publicarClases(){
		$ciclo = Ciclo::all()->last();
		$grupos = Grupo::where('ciclo_id','=',$ciclo->id)
						->get();
		foreach ($grupos as $grupo) {
			Clase::crearClases($grupo->id);
		}
	}
}

$faker = new Faker;

/*********** catalogos obligatorios **************/
$faker->generarCatalogos();

/*********** generar nuevo ciclo ***************/
$faker->generarNuevoCuatrimestre();