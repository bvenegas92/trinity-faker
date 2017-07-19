<?php

require __DIR__.'/vendor/autoload.php';

use Trinity\Faker\Entities\Carrera;
use Trinity\Faker\Entities\Asignatura;
use Trinity\Faker\Entities\Aula;
use Trinity\Faker\Entities\Horario;
use Trinity\Faker\Entities\Ciclo;
use Trinity\Faker\Entities\Alumno;
use Trinity\Faker\Entities\Grupo;
use Trinity\Faker\Entities\Clase;
use Trinity\Faker\Entities\Profesor;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Collection;
use Trinity\Faker\Data\DummyData;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'trinity',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

function pr($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

class Faker
{
	/**
	 * Crea cada una de las carreras del catalogo
	 */
	public function crearCarreras()
	{
		foreach (DummyData::$carreras as $clave => $nombre) {
			if (Carrera::where('nombre', '=', $nombre)->get()->isEmpty()) {
				echo "Creando carrera: \"".$nombre."\"\n";
				$carrera = Carrera::create(array('clave' => $clave, 'nombre' => $nombre));
			}
		}
	}

	/**
	 * Crea cada una de las asignaturas del catalogo
	 */
	public function crearAsignaturas()
	{
		$asignaturas = DummyData::$asignaturas;
		$asignaturas = call_user_func_array("array_merge", array_values($asignaturas));
		$asignaturas = call_user_func_array("array_merge", array_values($asignaturas));
		$asignaturas = array_unique($asignaturas);
		foreach ($asignaturas as $asignatura) {
			if (Asignatura::where('nombre', '=', $asignatura)->get()->isEmpty()) {
				echo "Creando asignatura: \"".$asignatura."\"\n";
				$asignatura = Asignatura::create(array('nombre' => $asignatura));
			}
		}
	}

	/**
	 * Crea cada una de las aulas del catalogo
	 */
	public function crearAulas()
	{
		$aula = 0;
		for ($numEdificio = 1; $numEdificio <= 5; $numEdificio++) {
			for ($numPiso = 1; $numPiso <= 4; $numPiso++) {
				for ($numAula = 1; $numAula <= 8; $numAula++) {
					$aula = $numEdificio * 100 + $numPiso * 10 + $numAula;
					$existe = !Aula::where('nombre', '=', $aula)->get()->isEmpty();
					if (!$existe) {
						echo "Creando aula: ".$aula."\n";
						Aula::create(array(
							"nombre" => $aula
						));
					}
				}
			}
		}
	}

	/**
	 * Crea cada uno de los horarios del catalogo
	 */
	public function crearHorarios()
	{
		$diasSemana = array("LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES");
		$dia = 0;
		$horaInicio = "";
		$horaFin = "";
		for ($i = 0; $i < 5; $i++) { // dias de la semana
			for ($j = 7; $j < 16; $j++) { // horas del dia
				$dia = $i;
				$horaInicio = str_pad($j.":00:00", 8, STR_PAD_LEFT);
				$horaFin = str_pad($j.":50:00", 8, STR_PAD_LEFT);
				$existe = !Horario::where('dia', '=', $i)
					->where('hora_inicio', '=', $horaInicio)
					->where('hora_fin', '=', $horaFin)
					->get()->isEmpty();
				if (!$existe) {
					echo "Creando horario: ".$diasSemana[$dia]." - ".$horaInicio." - ".$horaFin."\n";
					Horario::create(array(
						'hora_inicio' => $horaInicio,
						'hora_fin' => $horaFin,
						'dia' => $dia
					));
				}
			}
		}
	}

	/**
     * Reparte la cantidad de horas de clase a la semana a cada asignatura
     * @param  integer $numAsignaturas
     * @param  integer $horas
     * @return array Array con las horas de cada asignatura
     */
    public function repartirHoras($numAsignaturas, $horas)
    {
        $reparto = array();
        for ($i = $numAsignaturas; $i > 0; $i--) {
            $promedio = intval($horas / $i);
            $residuo = $horas % $i;
            $cantidad = $promedio + ($i == 1 ? $residuo : rand(0, $residuo));
            $reparto[] = $cantidad;
            $horas -= $cantidad;
        }
        return $reparto;
    }

	/**
	 * Relaciona las asignaturas con sus respectivas carreras dandole un numero de
	 * cuatrimestre y un numero de horas a la semana
	 */
	public function relacionarAsignaturasConCarreras()
	{
		$horasSemana = 40;
		$asignaturas = DummyData::$asignaturas;

		foreach ($asignaturas as $claveCarrera => $cuatrimestres) {
			$carrera = Carrera::where('clave', '=', $claveCarrera)->get()->first();
			$numCuatri = 0;
			echo "Relacionando las asignaturas de la carrera de: \"".$carrera->nombre."\"\n";
			foreach ($cuatrimestres as $cuatrimestre) {
				$numCuatri++;
				$horasRepartidas = $this->repartirHoras(count($cuatrimestre), $horasSemana);
				$numAsignatura = 0;
				echo "Relacionando el cuatrimestre: ".$numCuatri."\n";
				foreach ($cuatrimestre as $asignatura) {
					$asign = Asignatura::where('nombre', '=', $asignatura)->get()->first();
					$existe = !$carrera->asignaturas()->where('id', '=', $asign->id)->get()->isEmpty();
					if(!$existe){
						$carrera->asignaturas()->attach(
							$asign->id,
							array('cuatrimestre' => $numCuatri, 'horas_semana' => $horasRepartidas[$numAsignatura])
						);
						echo "Asignatura: \"".$asign->nombre."\"  Horas: ".$horasRepartidas[$numAsignatura]."\n";
					}
					$numAsignatura++;
				}
			}
		}
	}

	/**
	 * Genera los catalogos base
	 */
	public function generarCatalogos()
	{
		echo "-----     Generando carreras...\n";
		$this->crearCarreras();
		echo "-----     Generando asignaturas...\n";
		$this->crearAsignaturas();
		echo "-----     Generando aulas...\n";
		$this->crearAulas();
		echo "-----     Generando horarios...\n";
		$this->crearHorarios();
		echo "-----     Relacionando asignaturas con carreras...\n";
		$this->relacionarAsignaturasConCarreras();
	}

	/**
     * Crea nuevo ciclo (cuatrimestre) de acuerdo al mas actual.
     * O el ciclo "SEP-2010 - DIC-2010" en caso que no exista ninguno
     */
    public function crearCiclo()
    {
        $meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP' ,'OCT', 'NOV', 'DIC');
        $nombre = "";
        $fechaInicio = "";
        $fechaFin = "";

        $ultimoCiclo = Ciclo::orderBy("fecha_fin", "desc")->get()->first();
        if ($ultimoCiclo == null) {
            $nombre = "SEP-2010 - DIC-2010";
            $fechaInicio = "2010-09-01";
            $fechaFin = "2010-12-20";
            echo "Creando ciclo: ".$nombre."\n";
            $ciclo = Ciclo::create(array(
                'nombre' => $nombre,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin
            ));
        } else {
            $fechaInicio = new DateTime($ultimoCiclo->fecha_inicio);
            $fechaFin = new DateTime($ultimoCiclo->fecha_fin);
            $fechaInicio->add(new DateInterval('P4M'));
            $fechaFin->add(new DateInterval('P4M'));
            $nombre = $meses[intval($fechaInicio->format('m')) - 1].'-'.$fechaInicio->format('Y').' - '.
                $meses[intval($fechaFin->format('m')) - 1].'-'.$fechaFin->format('Y');
            echo "Creando ciclo: ".$nombre."\n";
            $ciclo = Ciclo::create(array(
                'nombre' => $nombre,
                'fecha_inicio' => $fechaInicio->format('Y-m-d'),
                'fecha_fin' => $fechaFin->format('Y-m-d')
            ));
        }

        return $ciclo;
    }

    /**
     * Crea un nuevo grupo
     * @param  string  $nombre
     * @param  Carrera  $carrera
     * @param  Ciclo  $ciclo
     * @param  integer $cuatrimestre
     * @return Grupo
     */
    public function crearGrupo($nombre, $carrera, $ciclo, $cuatrimestre = 1)
    {
        echo "Creando grupo: ".$nombre."\n";
        $grupo = Grupo::create(array(
            'nombre' => $nombre,
            'carrera_id' => $carrera->id,
            'ciclo_id' => $ciclo->id,
            'cuatrimestre' => $cuatrimestre
        ));
        return $grupo;
    }

    /**
     * Obtiene una curp disponible
     * @param  string $nombre
     * @param  string $paterno
     * @param  string $materno
     * @param  string $fecha
     * @param  string $genero
     * @param  string $estado
     * @return string
     */
    public function getCurp($nombre, $paterno, $materno, $fecha, $genero, $estado)
    {
        $nombre = str_replace(
            array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'),
            array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'),
            $nombre
        );
        $paterno = str_replace(
            array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'),
            array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'),
            $paterno
        );
        $materno = str_replace(
            array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'),
            array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'),
            $materno
        );

        $curp = $paterno[0];//primera letra apellido paterno
        preg_match("/([aeiou])/", substr($paterno, 1), $vocal);
        $curp .= $vocal[1]; //primera vocal interna apellido paterno
        $curp .= $materno[0]; //primera letra apellido materno
        $curp .= $nombre[0]; //primera letra nombre
        $fecha = new DateTime($fecha);
        $curp .= $fecha->format('y'); //año
        $curp .= $fecha->format('m'); //mes
        $curp .= $fecha->format('d'); //dia
        $curp .= $genero; //genero
        $curp .= $estado; //clave estado
        preg_match("/([^aeiou])/i", substr($paterno, 1), $consonante);
        $curp .= array_key_exists(1, $consonante) ? $consonante[1] : "X"; //primera consonante interna apellido paterno;
        preg_match("/([^aeiou])/i", substr($materno, 1), $consonante);
        $curp .= array_key_exists(1, $consonante) ? $consonante[1] : "X"; //primera consonante interna apellido materno;
        preg_match("/([^aeiou])/i", substr($nombre, 1), $consonante);
        $curp .= array_key_exists(1, $consonante) ? $consonante[1] : "X"; //primera consonante interna del nombre;

        //homoclave
        for($i = 48; $i <= 90; $i += ($i == 57 ? 8 : 1)) { // [0-9A-Z]
            for ($j = 1; $j <= 9; $j++) { // [1-9]
                $isDisponible = Alumno::where('curp', "=", strtoupper($curp.chr($i).$j))->get()->isEmpty();
                if ($isDisponible) {
                    $isDisponible = Profesor::where('curp', "=", strtoupper($curp.chr($i).$j))->get()->isEmpty();
                }
                if ($isDisponible) {
                    return strtoupper($curp.chr($i).$j);
                }
            }
        }

        return strtoupper($curp."00");
    }

    /**
     * Obtiene una matricula disponible
     * @param  Carrera $carrera
     * @param  string $curp
     * @param  integer $anoIngreso
     * @param  integer $month
     * @return string
     */
    public function getMatricula($carrera, $curp, $anoIngreso)
    {
        $matricula = $carrera->clave;
        $matricula .= substr(strval($anoIngreso), 2, 2);
        $count = Alumno::where('matricula', 'like', '%'.substr($matricula, 0, 5).'%')->count();
        $matricula .= str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $matricula;
    }

    /**
     * Crea un alumno de la carrera proporcionada
     * @param  Carrera $carrera
     * @param  integer $ano
     * @return Alumno
     */
    public function crearAlumno($carrera, $anoIngreso)
    {
        $genero = rand(0, 1) ? "H" : "M";
        $primerNombre = DummyData::$nombres[$genero][rand(0, count(DummyData::$nombres[$genero]) - 1)];
        $segundoNombre = DummyData::$nombres[$genero][rand(0, count(DummyData::$nombres[$genero]) - 1)];
        $nombres = rand(0, 1) ? $primerNombre : $primerNombre." ".$segundoNombre;
        $apellidoPaterno = DummyData::$apellidos[rand(0, count(DummyData::$apellidos) - 1)];
        $apellidoMaterno = DummyData::$apellidos[rand(0, count(DummyData::$apellidos) - 1)];
        $anoNacimiento = $anoIngreso - rand(18, 19);
        $mesNacimiento = rand(1, 12);
        $diaNacimiento = rand(1, 28);
        $fechaNacimiento = $anoNacimiento."-".$mesNacimiento."-".$diaNacimiento;
        $ciudad = DummyData::$ciudades[rand(0, count(DummyData::$ciudades) - 1)];
        $nombreCiudad = $ciudad['ciudad'];
        $nombreEstado = $ciudad['estado'];
        $clave = $ciudad["clave"];
        $curp = $this->getCurp($primerNombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $genero, $clave);
        $matricula = $this->getMatricula($carrera, $curp, $anoIngreso);

        echo "Creando alumno: \"".$nombres." ".$apellidoPaterno." ".$apellidoMaterno."\"\n";
        return Alumno::create(array(
            'matricula' => $matricula,
            'nombre' => $nombres,
            'apellido_paterno' => $apellidoPaterno,
            'apellido_materno' => $apellidoMaterno,
            'fecha_nacimiento' => $fechaNacimiento,
            'curp' => $curp,
            'genero' => $genero,
            'ciudad' => $nombreCiudad,
            'estado' => $nombreEstado,
            'carrera_id' => $carrera->id
        ));
    }

    /**
     * Genera alumnos con el grupo proporcionado
     * @param  Grupo $grupo
     * @return Collection
     */
    public function generarAlumnos($carrera, $ciclo, $numAlumnos)
    {
        $alumnosNuevos = new Collection();

        for ($i = 0; $i < $numAlumnos; $i++) {
            $alumno = $this->crearAlumno($carrera, intval(substr($ciclo->fecha_inicio, 0, 4)));
            $alumnosNuevos->add($alumno);
        }

        return $alumnosNuevos;
    }

    /**
     * Genera grupos del ciclo
     * @param  Ciclo $ciclo
     * @return Collection
     */
    public function generarGrupos($cicloAnterior, $nuevoCiclo)
    {
        $gruposNuevos = new Collection();

        echo "-----     Generando grupos del ciclo ".$nuevoCiclo->nombre."...\n";
        // grupos por avanzar
        if ($cicloAnterior != null) {
            foreach ($cicloAnterior->grupos as $grupoAnterior) {
                $grupoAnterior->load(array("carrera", "alumnos"));
                if ($grupoAnterior->cuatrimestre < 10) {
                    $grupo = $this->crearGrupo(
                        preg_replace("/([A-Z]{3}) (\d)-(\d)/", "$1 ".($grupoAnterior->cuatrimestre + 1)."-$3", $grupoAnterior->nombre),
                        $grupoAnterior->carrera,
                        $nuevoCiclo,
                        $grupoAnterior->cuatrimestre + 1
                    );
                    $grupo->alumnos()->attach(array_fetch($grupoAnterior->alumnos->toArray(), 'id'));
                    $gruposNuevos->add($grupo);
                }
            }
        }

        // grupos nuevos
        if (preg_match("/SEP/", $nuevoCiclo->nombre)) {
            $carreras = Carrera::all();
            foreach ($carreras as $carrera) {
                for ($i = 1; $i <= 3; $i++) {
                    $grupo = $this->crearGrupo($carrera->clave.' 1-'.$i, $carrera, $nuevoCiclo, 1);
                    $grupo->carrera = $carrera;
                    $grupo->ciclo = $nuevoCiclo;
                    echo "-----     Generando alumnos de nuevo ingreso del grupo ".$grupo->nombre."...\n";
                    $grupo->alumnos = $this::generarAlumnos($carrera, $nuevoCiclo, rand(25, 30));
                    $grupo->alumnos()->attach(array_fetch($grupo->alumnos->toArray(), 'id'));
                    $gruposNuevos->add($grupo);
                }
            }
        }

        return $gruposNuevos;
    }

    /**
     * Generar calificaciones del ciclo
     * @param  Ciclo $ciclo
     */
    public function generarCalificaciones($ciclo)
    {
        echo "-----     Generando calificaciones del ciclo ".$ciclo->nombre."...\n";
        $grupos = $ciclo->grupos;

        foreach ($grupos as $grupo) {
            echo "-----     Generando calificaciones del grupo ".$grupo->nombre."...\n";
            $asignaturas = Asignatura::with(array('carreras' => function($q) use ($grupo) {
                    $q->where('carrera_id', '=', $grupo->carrera_id);
                }))
                ->whereHas('carreras', function($q) use ($grupo){
                    $q->where('carrera_id', '=', $grupo->carrera_id)
                        ->where('cuatrimestre', '=', $grupo->cuatrimestre);
                })
                ->get();
            $alumnos = Alumno::whereHas('grupos', function($q) use ($grupo) {
                    $q->where('grupo_id', '=', $grupo->id);
                })
                ->get();
            foreach ($alumnos as $alumno) {
                echo "Calificaciones del alumno: ".$alumno->matricula."...\n";
                foreach ($asignaturas as $asignatura) {
                    $corte1 = min(10, rand(7, 10) + (rand(0, 9) / 10));
                    $corte2 = min(10, rand(7, 10) + (rand(0, 9) / 10));
                    $corte3 = min(10, rand(7, 10) + (rand(0, 9) / 10));
                    echo $asignatura->nombre.": ".$corte1.", ".$corte2.", ".$corte3."\n";
                    $alumno->addCalificaciones($asignatura, $corte1, $corte2, $corte3);
                }
            }
        }
    }

    /**
     * Crea un profesor
     * @return Profesor
     */
    public function crearProfesor()
    {
    	$genero = rand(0, 1) ? "H" : "M";
        $primerNombre = DummyData::$nombres[$genero][rand(0, count(DummyData::$nombres[$genero]) - 1)];
        $segundoNombre = DummyData::$nombres[$genero][rand(0, count(DummyData::$nombres[$genero]) - 1)];
        $nombres = rand(0, 1) ? $primerNombre : $primerNombre." ".$segundoNombre;
        $apellidoPaterno = DummyData::$apellidos[rand(0, count(DummyData::$apellidos) - 1)];
        $apellidoMaterno = DummyData::$apellidos[rand(0, count(DummyData::$apellidos) - 1)];
        $anoNacimiento = rand(1970, 1980);
        $mesNacimiento = rand(1, 12);
        $diaNacimiento = rand(1, 28);
        $fechaNacimiento = $anoNacimiento."-".$mesNacimiento."-".$diaNacimiento;
        $ciudad = DummyData::$ciudades[rand(0, count(DummyData::$ciudades) - 1)];
        $nombreCiudad = $ciudad['ciudad'];
        $nombreEstado = $ciudad['estado'];
        $clave = $ciudad["clave"];
        $curp = $this->getCurp($primerNombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $genero, $clave);

		return Profesor::create(array(
			'nombre' => $nombres,
			'apellido_paterno' => $apellidoPaterno,
			'apellido_materno' => $apellidoMaterno,
			'fecha_nacimiento' => $fechaNacimiento,
			'curp' => $curp,
			'genero' => $genero,
			'ciudad' => $nombreCiudad,
			'estado' => $nombreEstado
		));
	}

    /**
     * Genera clases para los grupos
     * @param  Collection<Grupo> $grupos
     */
    public function generarClases($grupos)
    {
        foreach ($grupos as $grupo) {
            echo "-----     Generando clases del grupo " . $grupo->nombre . "...\n";
            $profesorDisponible = null;
            $ciclo = $grupo->ciclo;
            // obtiene las asignaturas del grupo
            $asignaturas = Asignatura::with(array('carreras' => function($q) use ($grupo){
                    $q->where('carrera_id', '=', $grupo->carrera_id);
                }))
                ->whereHas('carreras', function($q) use ($grupo){
                    $q->where('carrera_id', '=', $grupo->carrera_id)
                        ->where('cuatrimestre', '=', $grupo->cuatrimestre);
                })
                ->get();
            foreach ($asignaturas as $asignatura) {
                $horasSemana = $asignatura->carreras->first()->pivot->horas_semana;

                // horarios disponibles de la clase
                $horariosDisponiblesGrupo = $grupo->getHorariosDisponibles();

                // se busca un profesor disponible que imparta la asignatura
                $profesorDisponible = Profesor::getProfesorDisponible($horariosDisponiblesGrupo, $asignatura, $grupo, $ciclo, $horasSemana);
                if ($profesorDisponible == null) {
                	// si no existe un diponible se crea
                    $profesorDisponible = $this->crearProfesor();
                    $profesorDisponible->asignaturas()->attach($asignatura->id);
                }

                // horarios diponibles del profesor
                $horariosDisponiblesProfesor = $profesorDisponible->getHorariosDisponibles($ciclo);

                // horarios disponibles del profesoy y el grupo
                $horariosDisponibles = $horariosDisponiblesGrupo->intersect($horariosDisponiblesProfesor);

                // organiza los horarios de la asignatura en la semana
                $horariosSeleccionados = new Collection;
				while ($horasSemana > 0) {
					for ($numDia = 0; $numDia < 5 && $horasSemana > 0; $numDia++) {
						foreach ($horariosDisponibles as $key => $horario) {
							if ($horario->dia == $numDia) {
								$horariosSeleccionados->push($horariosDisponibles->pull($key));
								$horasSemana--;
								break;
							}
						}
					}
				}

				// crea las clases
				foreach ($horariosSeleccionados as $horario) {
                    echo "Creando clase: " . $asignatura->nombre . " " .
                        $horario->hora_inicio . " - " . $horario->hora_fin . "...\n";
					$aula = Aula::getAulaDisponible($horario, $ciclo);
					$clase = Clase::create(array(
						'profesor_id' => $profesorDisponible->id,
						'grupo_id' => $grupo->id,
						'asignatura_id' => $asignatura->id,
						'aula_id' => $aula->id,
						'horario_id' => $horario->id,
						"ciclo_id" => $ciclo->id
					));
				}
            }
        }
    }

	/**
     * Genera un nuevo cuatrimestre creando una nueva generacion y/o
     * avanzando las actuales en caso que existan
     */
    public function generarNuevoCuatrimestre()
    {
        echo "-----     Generando nuevo cuatrimestre...\n";

        $cicloAnterior = Ciclo::with("grupos")->orderBy("fecha_fin", "desc")->get()->first();
        if ($cicloAnterior != null) {
            // genera calificaciones del ciclo anterior
            $this->generarCalificaciones($cicloAnterior);
        }

        // genera nuevo ciclo
        $nuevoCiclo = $this->crearCiclo();
        $nuevoCiclo->grupos = $this->generarGrupos($cicloAnterior, $nuevoCiclo);

        // genera clases
        $this->generarClases($nuevoCiclo->grupos);
    }

    /**
     * Genera una generacion de acuerdo al cuatrimestre del ultimo ciclo
     */
    public function generarNuevaGeneracion()
    {
        $ciclos = Ciclo::all();
        if ($ciclos->count() > 0) {
            $ultimoCuatrimestre = Grupo::where('ciclo_id', '=', $ciclos->last()->id)->max('cuatrimestre');
            for ($i = $ultimoCuatrimestre; $i <= 10; $i++) {
                $this->generarNuevoCuatrimestre();
            }
        }
        else{
            for ($i = 1; $i <= 10; $i++) {
                $this->generarNuevoCuatrimestre();
            }
        }
    }
}

$faker = new Faker;

/****************************************************/
/***************     ADVERTENCIA     ****************/
/****  PUEDE DURAR VARIOS MINUTOS INCLUSO HORAS  ****/
/****  DEPENDIENDO DE LA CANTIDAD DE INFORMACION  ***/
/****************************************************/


/******************   CATALOGOS   *******************/
//$faker->generarCatalogos();

/**********   GENERAR NUEVO CUATRIMESTRE   **********/
//$faker->generarNuevoCuatrimestre();

/**********   GENERAR NUEVAS GENERACIONES   *********/
$faker->generarNuevaGeneracion();
