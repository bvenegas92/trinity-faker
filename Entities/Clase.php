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

	public static function crearClases($grupo_id){
		//echo "Creando clases\n";
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
			//echo "Creando clases para una asignatura id:".$asignatura->id."\n";
			$horas_semana = $asignatura->carreras->first()->pivot->horas_semana;

			$profesor = Profesor::disponible($horas_semana, $asignatura->id);
			$horarios_seleccionados = Horario::seleccionarPorProfesor($profesor->id, $horas_semana);
			foreach ($horarios_seleccionados as $horario) {
				//echo "Creando clase por horario\n";
				$aula = Aula::disponible($horario->id);
				$clase = Clase::create(array(
							'profesor_id' => $profesor->id,
							'grupo_id' => $grupo->id,
							'asignatura_id' => $asignatura->id,
							'aula_id' => $aula->id,
							'horario_id' => $horario->id
						));
				echo 'Clase: '.$horario->dia.' '.$horario->hora_inicio.'-'.$horario->hora_fin.' Grp: '.$grupo->nombre."Prof: ".$profesor->nombre." Asig: ".$asignatura->id."\n";
			}
		}
	}
}