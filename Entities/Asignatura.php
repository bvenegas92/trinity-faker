<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use Trinity\Faker\Data\DummyData;

class Asignatura extends Model
{

	protected $table = 'asignaturas';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con calificaciones
	 * @return BelongsToMany
	 */
	public function calificaciones()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Alumno', 'calificaciones', 'asignatura_id', 'alumno_id')
			->withPivot('corte_1', 'corte_2', 'corte_3');
	}

	/**
	 * Relacion con carreras
	 * @return BelongsToMany
	 */
	public function carreras()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Carrera', 'asignaturas_carreras', 'asignatura_id', 'carrera_id')
			->withPivot('cuatrimestre', 'horas_semana');
	}

	/**
	 * Relacion con profesores
	 * @return BelongsToMany
	 */
	public function profesores()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Profesor', 'asignaturas_profesores', 'asignatura_id', 'profesor_id');
	}

	/**
	 * Relacion con clases
	 * @return HasMany
	 */
	public function clases()
	{
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'aula_id');
	}
}
