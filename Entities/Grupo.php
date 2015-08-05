<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model{

	protected $table = 'grupos';

	public $timestamps = false;

	public $guarded = array('id');

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

	public static function crearGrupo($nombre, $carrera_id, $cuatrimestre = 1){
		$ciclo = Ciclo::all()->last();
		$grupo = Grupo::create(array(
			'nombre' => $nombre,
			'carrera_id' => $carrera_id,
			'ciclo_id' => $ciclo->id,
			'cuatrimestre' => $cuatrimestre
		));
		echo 'Grupo: '.$grupo->nombre." creado\n";
		$num_alumnos = rand(25, 30);
		for ($i=0; $i < $num_alumnos; $i++) { 
			$alumno = Alumno::crearAlumno($carrera_id);
			$alumno->grupos()->attach($grupo->id);
			echo 'Alumno: '.$alumno->nombre." creado\n";
		}
		return $grupo;
	}
}