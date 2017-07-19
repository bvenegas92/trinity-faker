<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Horario extends Model
{

	protected $table = 'horarios';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con clases
	 * @return HasMany
	 */
	public function clases()
	{
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'horario_id');
	}
}
