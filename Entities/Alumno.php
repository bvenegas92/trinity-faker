<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Alumno extends Model{

	protected $table = 'alumnos';

	public $timestamps = false;

	public $guarded = array('id');

	public function calificaciones(){
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'calificaciones', 'alumno_id', 'asignatura_id')
						->withPivot('corte_1', 'corte_2', 'corte_3');
	}

	public function grupos(){
		return $this->belongsToMany('Trinity\Faker\Entities\Grupo', 'alumnos_grupos', 'alumno_id', 'grupo_id');
	}

	public static function crearAlumno($carrera_id, $year){
		$genero = rand(0,1) ? "H" : "M";
		$nombre = self::randomNombre($genero).(rand(0,1) ? " ".self::randomNombre($genero) : "");
		$apellido_paterno = self::randomApellido();
		$apellido_materno = self::randomApellido();
		$fecha_nacimiento = self::randomFechaNacimiento(rand($year-19, $year-18));
		$ciudad_estado = self::randomCiudadEstado();
		$ciudad = $ciudad_estado['ciudad'];
		$estado = $ciudad_estado['estado'];
		$curp = self::curp($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $genero, $ciudad_estado['clave']);
		$carrera = Carrera::find($carrera_id);
		$matricula = self::matricula($carrera, $curp, $year, 8);

		return self::create(array(
			'matricula' => $matricula,
			'nombre' => $nombre,
			'apellido_paterno' => $apellido_paterno,
			'apellido_materno' => $apellido_materno,
			'fecha_nacimiento' => $fecha_nacimiento,
			'curp' => $curp,
			'genero' => $genero,
			'ciudad' => $ciudad,
			'estado' => $estado,
			'carrera_id' => $carrera->id
		));
	}

	public static function matricula($carrera, $curp, $year, $month){
		$matricula = $carrera->clave;
		$matricula .= substr(strval($year),2,2);
		$matricula .= $month < 10 ? '0'.$month : $month;
		$matricula .= substr($curp,0,4);

		$count = self::where('matricula','like','%'.substr($matricula, 0, 7).'%')->count();
		$matricula .= str_pad($count+1, 5, '0', STR_PAD_LEFT);
		return $matricula;
	}

	public static function curp($nombre, $paterno, $materno, $fecha, $genero, $estado){
		$nombre = str_replace(array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'), array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'), $nombre);
		$paterno = str_replace(array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'), array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'), $paterno);
		$materno = str_replace(array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ñ', 'Ñ'), array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'x', 'X'), $materno);

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
		$curp .= $consonante[1]; //primera consonante interna apellido paterno;
		preg_match("/([^aeiou])/i", substr($materno, 1), $consonante);
		$curp .= $consonante[1]; //primera consonante interna apellido materno;
		preg_match("/([^aeiou])/i", substr($nombre, 1), $consonante);
		$curp .= $consonante[1]; //primera consonante interna del nombre;

		//homoclave
		for($i = 65; $i <= 90; $i++){
			if(Alumno::where('curp','like','%'.strtoupper($curp.chr($i)).'%')->get()->isEmpty()){
				$curp .= chr($i);
				break;
			}
		}

		$curp .= rand(1,9);

		return strtoupper($curp);
	}

	public static function randomCiudadEstado(){
		return self::$ciudades_estados[rand(0, count(self::$ciudades_estados)-1)];
	}

	public static function randomFechaNacimiento($year = 1990){
		return (new DateTime($year."-".rand(1,12)."-".rand(1,25)))->format('Y-m-d');
	}

	public static function randomApellido(){
		return self::$apellidos[rand(0, count(self::$apellidos)-1)];
	}

	public static function randomNombre($genero){
		return self::$nombres[$genero][rand(0, count(self::$nombres[$genero])-1)];
	}

	public static $ciudades_estados = array(
		array('clave' => 'SL', 'estado' => 'Sinaloa', 'ciudad' => 'Mazatlan'),
		array('clave' => 'SL', 'estado' => 'Sinaloa', 'ciudad' => 'Culiacan'),
		array('clave' => 'SL', 'estado' => 'Sinaloa', 'ciudad' => 'Los Mochis'),
		array('clave' => 'JC', 'estado' => 'Jalisco', 'ciudad' => 'Guadalajara'),
		array('clave' => 'JC', 'estado' => 'Jalisco', 'ciudad' => 'Zapopan'),
		array('clave' => 'SR', 'estado' => 'Sonora', 'ciudad' => 'Ciudad Obregon'),
		array('clave' => 'SR', 'estado' => 'Sonora', 'ciudad' => 'Hermosillo'),
		array('clave' => 'NT', 'estado' => 'Nayarit', 'ciudad' => 'Tepic')
	);

	public static $nombres = array(
	"H" => array("Adriano", "Adrián", "Agustín", "Amadeo", "Amado", "Amador", "Antonino", "Augusto", "Aurelio", "Avelino", "Benedicto", "Benito", "Bonifacio", "Camilo", "Casto", "Cayetano", "Cecilio", "Celestino", "Celso", "Cipriano", "Claudio", "Clemente", "Constantino", "Cornelio", "Cristian", "Cruz", "Cándido", "César", "Desiderio", "Domingo", "Fabián", "Fabricio", "Facundo", "Faustino", "Fausto", "Fermín", "Fidel", "Florencio", "Félix", "Gabino", "Genaro", "Horacio", "Ignacio", "Julio", "Julián", "Lorenzo", "Luciano", "Marcelino", "Marcelo", "Marcos", "Mariano", "Mario", "Martín", "Mauricio", "Octavio", "Pablo", "Patricio", "Paul", "Pedro", "René", "Román", "Salvador", "Sergio", "Vicente", "Víctor"),
	"M" => array("Adriana", "Agustína", "Alba", "Altagracia", "Amanda", "Amparo", "Angélica", "Antonina", "Araceli", "Asunción", "Aurelia", "Aurora", "Avelina", "Beatriz", "Bonifacia", "Camila", "Candelaria", "Caridad", "Cecilia", "Celestina", "Claudia", "Clementina", "Concepción", "Constancia", "Consuelo", "Cornelia", "Cristina", "Cándida", "Diana", "Dolores", "Esperanza", "Estela", "Fabiana", "Flor", "Florencia", "Gloria", "Hortensia", "Inés", "Julia", "Laura", "Leticia", "Lucía", "Luz", "Mariana", "Marina", "Natalia", "Norma", "Olivia", "Paloma", "Patricia", "Paula", "Renata", "Rocío", "Rosalba", "Silvia", "Valentina", "Verónica", "Victoria", "Virginia", "Ximena", "Yuridia", "Yolanda")
	);

	public static $apellidos = array(
		"Acosta", "Acuña", "Agüero", "Aguilera", "Aguirre", "Alarcón", "Alvarado", "Álvarez", "Arce", "Arias", "Ávila", "Barrios", "Benítez", "Blanco", "Bravo", "Bustamante", "Bustos", "Cabrera", "Campos", "Cárdenas", "Cardozo", "Carrasco", "Carrizo", "Carvajal", "Castillo", "Castro", "Chávez", "Contreras", "Córdoba", "Cortés", "Díaz", "Domínguez", "Duarte", "Escobar", "Espinoza", "Farías", "Fernández", "Figueroa", "Flores", "Franco", "Fuentes", "Gallardo", "García", "Gómez", "González", "Guerrero", "Gutiérrez", "Guzmán", "Hernández", "Herrera", "Jara", "Jiménez", "Juárez", "Lagos", "Ledesma", "Leiva", "López", "Luna", "Maldonado", "Mansilla", "Martinez", "Medina", "Méndez", "Mendoza", "Molina", "Montenegro", "Morales", "Moreno", "Muñoz", "Navarrete", "Navarro", "Núñez", "Ojeda", "Olivares", "Olivera", "Ortega", "Ortiz", "Páez", "Palma", "Paredes", "Parra", "Paz", "Peña", "Peralta", "Pereyra", "Pérez", "Pino", "Ponce", "Quiroga", "Ramírez", "Ramos", "Reyes", "Ríos", "Rivera", "Rodríguez", "Rojas", "Romero", "Ruiz", "Salazar", "Salinas", "Sánchez", "Sandoval", "Sepúlveda", "Silva", "Soto", "Suárez", "Tapia", "Toledo", "Torres", "Valdés", "Valdez", "Valenzuela", "Vargas", "Vásquez", "Vázquez", "Vega", "Velázquez", "Venegas", "Vergara", "Vidal", "Yáñez", "Zúñiga"
	);
}