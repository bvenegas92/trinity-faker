<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Grupo extends Model
{

	protected $table = 'grupos';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con alumnos
	 * @return BelongsToMany
	 */
	public function alumnos()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Alumno', 'alumnos_grupos', 'grupo_id', 'alumno_id');
	}

	/**
	 * Relacion con carrera
	 * @return BelongsTo
	 */
	public function carrera()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Carrera', 'carrera_id');
	}

	/**
	 * Relacion con ciclo
	 * @return BelongsTo
	 */
	public function ciclo()
	{
		return $this->belongsTo('Trinity\Faker\Entities\Ciclo', 'ciclo_id');
	}

	/**
	 * Relacion con clases
	 * @return HasMany
	 */
	public function clases()
	{
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'grupo_id');
	}

	/**
	 * Obtiene los horarios disponibles del grupo
	 * @return Collection<Horario>
	 */
	public function getHorariosDisponibles()
	{
        $horariosDisponibles = Horario::whereDoesntHave('clases', function($q) {
                $q->where('grupo_id', '=', $this->id);
            })->get();

        return $horariosDisponibles;
	}
}
