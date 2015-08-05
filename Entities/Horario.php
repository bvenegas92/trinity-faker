<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Horario extends Model{

	protected $table = 'horarios';

	public $timestamps = false;

	public $guarded = array('id');

	public function clases(){
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'horario_id');
	}

	public static function seleccionarPorProfesor($profesor_id, $horas_semana){
		//echo "Seleccionando horarios por profesor id:".$profesor_id."\n";
		$ciclo = Ciclo::all()->last();
		$horarios_gral = Horario::all();
		$horarios_ocupados = Horario::select('horarios.*')
									->distinct()
									->join('clases','clases.horario_id','=','horarios.id')
									->join('grupos','grupos.id','=','clases.grupo_id')
									->where('profesor_id','=',$profesor_id)
									->where('ciclo_id','=',$ciclo->id)
									->get();
		$horarios_disponibles = $horarios_gral->diff($horarios_ocupados);
		return self::organizarSemana($horarios_disponibles, $horas_semana);
	}

	public static function crearHorarios(){
		for($i = 0; $i < 5; $i++){
			for($j = 7; $j < 16; $j++){
				self::create(array(
					'hora_inicio' => ($j < 10 ? '0'.$j : $j).':00:00',
					'hora_fin' => ($j < 10 ? '0'.$j : $j).':50:00',
					'dia' => self::$dias[$i]
				));
				echo 'Horario '.self::$dias[$i]." ".($j < 10 ? '0'.$j : $j).":00 - ".($j < 10 ? '0'.$j : $j).":50 creado\n";
			}
		}
	}

	public static function organizarSemana($horarios, $cant){
		//echo "Organizando semana\n";
		//print_r('horas: '.$cant);
		//print_r($horarios->toArray());
		$semana = new Collection;
		while($cant > 0){
			for($i = 0; $i < 5 && $cant > 0; $i++){
				foreach ($horarios as $key => $horario) {
					if($horario->dia == Horario::$dias[$i]){
						$semana->push($horarios->pull($key));
						$cant--;
						break;
					}
				}
			}
		}
		return $semana;
	}

	public static $dias = array('LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES');
}