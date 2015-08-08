<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model{

	protected $table = 'profesores';

	public $timestamps = false;

	public $guarded = array('id');

	public function asignaturas(){
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'asignaturas_profesores', 'profesor_id', 'asignatura_id');
	}

	public function clases(){
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'profesor_id');
	}

	public static function disponible($horarios, $asignatura_id, $ciclo_id, $horas){
		$ciclo = Ciclo::find($ciclo_id);
		$asignatura = Asignatura::find($asignatura_id);
		$profesores_disponibles = self::whereHas('clases', function($q) use ($ciclo_id, $horarios){
											$q->whereHas('grupo', function($q) use ($ciclo_id){
												$q->where('ciclo_id','=',$ciclo_id);
											})
											->whereIn('horario_id', array_fetch($horarios->toArray(), 'id'));
										}, '<=', $horarios->count()-$horas)
										->whereHas('asignaturas', function($q) use ($asignatura){
											$q->where('asignatura_id','=',$asignatura->id);
										})
										->get();
		if($profesores_disponibles->count() > 0){
			return $profesores_disponibles->random();
		}

		$profesores_capacitables = Profesor::whereHas('clases', function($q) use ($ciclo_id, $horarios){
												$q->whereHas('grupo', function($q) use ($ciclo_id){
													$q->where('ciclo_id','=',$ciclo_id);
												})
												->whereIn('horario_id', array_fetch($horarios->toArray(), 'id'));
											}, '<=', $horarios->count()-$horas)
											->whereDoesntHave('asignaturas', function($q) use ($asignatura){
												$q->where('asignatura_id','=',$asignatura->id);
											})
											->has('asignaturas','<',10)
											->get();
		if($profesores_capacitables->count() > 0){
			$profesor = $profesores_capacitables->random();
			$profesor->asignaturas()->attach($asignatura->id);
			return $profesor;
		}

		$profesor = self::crearProfesor();
		$profesor->asignaturas()->attach($asignatura->id);
		return $profesor;
	}

	public static function crearProfesor(){
		$genero = rand(0,1) ? "H" : "M";
		$nombre = Alumno::randomNombre($genero).(rand(0,1) ? " ".Alumno::randomNombre($genero) : "");
		$apellido_paterno = Alumno::randomApellido();
		$apellido_materno = Alumno::randomApellido();
		$fecha_nacimiento = Alumno::randomFechaNacimiento(rand(1970, 1980));
		$ciudad_estado = Alumno::randomCiudadEstado();
		$ciudad = $ciudad_estado['ciudad'];
		$estado = $ciudad_estado['estado'];
		$curp = Alumno::curp($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $genero, $ciudad_estado['clave']);

		return self::create(array(
			'nombre' => $nombre,
			'apellido_paterno' => $apellido_paterno,
			'apellido_materno' => $apellido_materno,
			'fecha_nacimiento' => $fecha_nacimiento,
			'curp' => $curp,
			'genero' => $genero,
			'ciudad' => $ciudad,
			'estado' => $estado
		));
	}
}