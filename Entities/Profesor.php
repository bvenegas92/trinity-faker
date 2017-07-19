<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model{

	protected $table = 'profesores';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con asignaturas
	 * @return BelongsToMany
	 */
	public function asignaturas()
	{
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'asignaturas_profesores', 'profesor_id', 'asignatura_id');
	}

	/**
	 * Relacion con clases
	 * @return HasMany
	 */
	public function clases()
	{
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'profesor_id');
	}

	/**
	 * Obtiene un profesor disponible.
	 * Un profesor es disponible si imparte la `$asignatura` y no tiene clases en los `$horariosDisponibles`
	 * durante el `$ciclo`.
	 * O si existe un profesor con los horarios disponibles he imparte menos de 10 asignaturas, se le capacita
	 * en la `$asignatura`
	 * @param  Collection<Horario> $horariosDisponibles
	 * @param  Asignatura $asignatura
	 * @param  Ciclo $ciclo
	 * @param  integer $horasSemana
	 * @return Profesor|null
	 */
	public static function getProfesorDisponible($horariosDisponibles, $asignatura, $grupo, $ciclo, $horasSemana){
		$profesoresDisponibles = self::whereDoesntHave("clases", function($q) use ($grupo) {
				$q->where("grupo_id", "=", $grupo->id);
			})
			->whereHas('clases', function($q) use ($ciclo, $horariosDisponibles) {
                $q->where('ciclo_id', '=', $ciclo->id)
    			->whereIn('horario_id', array_fetch($horariosDisponibles->toArray(), 'id'));
            }, '<=', $horariosDisponibles->count() - $horasSemana)
            ->whereHas('asignaturas', function($q) use ($asignatura){
                $q->where('asignatura_id', '=', $asignatura->id);
            })
            ->get();

		if($profesoresDisponibles->count() > 0){
			return $profesoresDisponibles->random();
		}

		$profesoresCapacitables = self::whereDoesntHave("clases", function($q) use ($grupo) {
				$q->where("grupo_id", "=", $grupo->id);
			})
			->whereHas('clases', function($q) use ($ciclo, $horariosDisponibles) {
				$q->where('ciclo_id','=',$ciclo->id)
				->whereIn('horario_id', array_fetch($horariosDisponibles->toArray(), 'id'));
			}, '<=', $horariosDisponibles->count() - $horasSemana)
			->whereDoesntHave('asignaturas', function($q) use ($asignatura){
				$q->where('asignatura_id', '=', $asignatura->id);
			})
			->has('asignaturas', '<', 10)
			->get();

		if ($profesoresCapacitables->count() > 0) {
			$profesor = $profesoresCapacitables->random();
			$profesor->asignaturas()->attach($asignatura->id);
			return $profesor;
		}

		return null;
	}

	/**
	 * Obtiene los horarios disponibles del profesor en el `$ciclo`
	 * @return Collection<Horario>
	 */
	public function getHorariosDisponibles($ciclo)
	{
        $horariosDisponibles = Horario::whereDoesntHave('clases', function($q) use ($ciclo) {
                $q->where('profesor_id', '=', $this->id)
                ->where("ciclo_id", "=", $ciclo->id);
            })->get();

        return $horariosDisponibles;
	}
}
