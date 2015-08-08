<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model{

	protected $table = 'clases';

	public $timestamps = false;

	public $guarded = array(); 

	public function grupo(){
		return $this->belongsTo('Trinity\Faker\Entities\Grupo', 'grupo_id');
	}

	public function profesor(){
		return $this->belongsTo('Trinity\Faker\Entities\Profesor', 'profesor_id');
	}

	public function aula(){
		return $this->belongsTo('Trinity\Faker\Entities\Aula', 'aula_id');
	}

	public function horario(){
		return $this->belongsTo('Trinity\Faker\Entities\Horario', 'horario_id');
	}

	public static function crearClases($grupo_id, $ciclo_id){
		$grupo = Grupo::find($grupo_id);
		$asignaturas = Asignatura::with(array('carreras' => function($q) use ($grupo){
									$q->where('carrera_id','=',$grupo->carrera_id);
								}))
								->whereHas('carreras', function($q) use ($grupo){
									$q->where('carrera_id','=',$grupo->carrera_id)
										->where('cuatrimestre','=',$grupo->cuatrimestre);
								})
								->get();

		foreach($asignaturas as $asignatura){
			$horas_semana = $asignatura->carreras->first()->pivot->horas_semana;

			$horarios_disponibles = Horario::whereDoesntHave('clases', function($q) use ($grupo){
												$q->where('grupo_id','=',$grupo->id);
											})->get();

			$profesor = Profesor::disponible($horarios_disponibles, $asignatura->id, $ciclo_id, $horas_semana);

			$horarios_seleccionados = Horario::organizarSemana($horarios_disponibles, $profesor->id, $horas_semana, $ciclo_id);

			foreach ($horarios_seleccionados as $horario) {
				$aula = Aula::disponible($horario->id, $ciclo_id);
				$clase = Clase::create(array(
							'profesor_id' => $profesor->id,
							'grupo_id' => $grupo->id,
							'asignatura_id' => $asignatura->id,
							'aula_id' => $aula->id,
							'horario_id' => $horario->id
						));
			}
		}
	}
}