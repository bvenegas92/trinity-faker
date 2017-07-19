<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;

class Ciclo extends Model
{

	protected $table = 'ciclos';

	public $timestamps = false;

	public $guarded = array('id');

	/**
	 * Relacion con grupos
	 * @return HasMany
	 */
	public function grupos()
	{
		return $this->hasMany('Trinity\Faker\Entities\Grupo', 'ciclo_id');
	}
}
