<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;

class Ciclo extends Model{

	protected $table = 'ciclos';

	public $timestamps = false;

	public $guarded = array('id');

	public static function crearCiclo(){
		$ultimo_ciclo = self::all()->last();
		if($ultimo_ciclo == null){
			$ciclo = self::create(array(
				'nombre' => 'ENE-2010 - ABR-2010',
				'fecha_inicio' => '2010-01-01',
				'fecha_fin' => '2010-04-28'
			));
		}
		else{
			$inicio = new DateTime($ultimo_ciclo->fecha_inicio);
			$fin = new DateTime($ultimo_ciclo->fecha_fin);
			$inicio->add(new DateInterval('P4M'));
			$fin->add(new DateInterval('P4M'));

			$meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP' ,'OCT', 'NOV', 'DIV');

			$ciclo = self::create(array(
				'nombre' => $meses[intval($inicio->format('m'))-1].'-'.$inicio->format('Y').' - '.$meses[intval($fin->format('m'))-1].'-'.$fin->format('Y'),
				'fecha_inicio' => $inicio->format('Y-m-d'),
				'fecha_fin' => $fin->format('Y-m-d')
			));
		}
		echo 'Ciclo '.$ciclo->nombre." creado\n";
	}
}