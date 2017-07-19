<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model{

	protected $table = 'clases';

	public $timestamps = false;

	public $guarded = array();

	/**
	 * Relacion con grupo
	 * @return BelongsTo
	 */
	public function grupo()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Grupo', 'grupo_id');
	}

	/**
	 * Relacion con profesor
	 * @return BelongsTo
	 */
	public function profesor()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Profesor', 'profesor_id');
	}

	/**
	 * Relacion con asignatura
	 * @return BelongsTo
	 */
	public function asignatura()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Asignatura', 'asignatura_id');
	}

	/**
	 * Relacion con aula
	 * @return BelongsTo
	 */
	public function aula()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Aula', 'aula_id');
	}

	/**
	 * Relacion con horario
	 * @return BelongsTo
	 */
	public function horario()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Horario', 'horario_id');
	}
}
