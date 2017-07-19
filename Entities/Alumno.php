<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Trinity\Faker\Data\DummyData;

class Alumno extends Model{

	protected $table = 'alumnos';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con carrera
	 * @return BelongsTo
	 */
	public function carrera()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Carrera', 'carrera_id');
	}

	/**
	 * Relacion con calificaciones
	 * @return BelongsToMany
	 */
	public function calificaciones()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'calificaciones', 'alumno_id', 'asignatura_id')
			->withPivot('corte_1', 'corte_2', 'corte_3');
	}

	/**
	 * Relacion con grupos
	 * @return BelongsToMany
	 */
	public function grupos()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Grupo', 'alumnos_grupos', 'alumno_id', 'grupo_id');
	}

	/**
	 * Agrega las calificaciones del alumno en la asignatura proporcionada
	 * @param Asignatura $asignatura [description]
	 * @param float $corte1     [description]
	 * @param float $corte2     [description]
	 * @param float $corte3     [description]
	 */
	public function addCalificaciones($asignatura, $corte1, $corte2, $corte3)
	{
		$this->calificaciones()->attach(
			$asignatura->id,
			array('corte_1' => $corte1, 'corte_2' => $corte2, 'corte_3' => $corte3)
		);
	}
}
