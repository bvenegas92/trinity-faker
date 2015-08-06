<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Grupo extends Model{

	protected $table = 'grupos';

	public $timestamps = false;

	public $guarded = array('id');

	public function avanzarCiclo($ciclo_id){
		$carrera = $this->carrera;
		$nombre =  $carrera->clave.' '.($this->cuatrimestre+1).substr($this->nombre, 5, 2);
		$nuevo_grupo = Grupo::create(array(
			'nombre' => $nombre,
			'carrera_id' => $carrera->id,
			'ciclo_id' => $ciclo_id,
			'cuatrimestre' => $this->cuatrimestre+1
		));
		$nuevo_grupo->alumnos()->attach(array_fetch($this->alumnos->toArray(), 'id'));
		return $nuevo_grupo;
	}

	public function alumnos(){
		return $this->belongsToMany('Trinity\Faker\Entities\Alumno', 'alumnos_grupos', 'grupo_id', 'alumno_id');
	}

	public function carrera(){
		return $this->belongsTo('Trinity\Faker\Entities\Carrera', 'carrera_id');
	}

	public function ciclo(){
		return $this->belongsTo('Trinity\Faker\Entities\Ciclo', 'ciclo_id');
	}

	public function clases(){
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'grupo_id');
	}

	public static function crearGrupo($nombre, $carrera_id, $ciclo_id, $cuatrimestre = 1){
		$ciclo = Ciclo::find($ciclo_id);
		$year = intval((new DateTime($ciclo->fecha_inicio))->format('Y'));
		$grupo = Grupo::create(array(
			'nombre' => $nombre,
			'carrera_id' => $carrera_id,
			'ciclo_id' => $ciclo_id,
			'cuatrimestre' => $cuatrimestre
		));
		$num_alumnos = rand(25, 30);
		for ($i=0; $i < $num_alumnos; $i++) { 
			$alumno = Alumno::crearAlumno($carrera_id, $year);
			$alumno->grupos()->attach($grupo->id);
		}
		return $grupo;
	}
}