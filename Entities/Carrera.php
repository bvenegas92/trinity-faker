<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use Trinity\Faker\Data\DummyData;

class Carrera extends Model
{

	protected $table = 'carreras';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con alumnos
	 * @return HasMany
	 */
	public function alumnos()
	{
		return $this->hasMany('Trinity\Faker\Entities\Carrera', 'carrera_id');
	}

	/**
	 * Relacion con asignaturas
	 * @return BelongsToMany
	 */
	public function asignaturas()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'asignaturas_carreras', 'carrera_id', 'asignatura_id')
			->withPivot('cuatrimestre', 'horas_semana');
	}

	/**
	 * Relacion con grupos
	 * @return HasMany
	 */
	public function grupos()
	{
		return $this->hasMany('Trinity\Faker\Entities\Grupo', 'carrera_id');
	}
}
