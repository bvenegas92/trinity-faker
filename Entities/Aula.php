<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{

	protected $table = 'aulas';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con clases
	 * @return HasMany
	 */
	public function clases()
	{
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'aula_id');
	}

	/**
	 * Obtiene un aula disponible en el `$horario` proporcionado
	 * @param  Horario $horario
	 * @param  Ciclo $ciclo
	 * @return Aula
	 */
	public static function getAulaDisponible($horario, $ciclo)
	{
		$aula = self::whereDoesntHave('clases', function($q) use ($ciclo, $horario) {
				$q->where('ciclo_id', '=', $ciclo->id)
				->where('horario_id', '=', $horario->id);
			})
			->get()->random();
		return $aula;
	}
}
