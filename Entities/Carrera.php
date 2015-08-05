<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model{

	protected $table = 'carreras';

	public $timestamps = false;

	public $guarded = array('id', 'fecha_eliminacion');

	public function asignaturas(){
		return $this->belongsToMany('Trinity\Faker\Entities\Asignatura', 'asignaturas_carreras', 'carrera_id', 'asignatura_id')
						->withPivot('cuatrimestre', 'horas_semana');
	}

	public static $carreras = array(
		'TPF' => 'Licenciatura en Terapia Física',
		'AGP' => 'Licenciatura en Administración y Gestión de PyMES',
		'BIO' => 'Ingeniería en Biotecnología',
		'INF' => 'Ingeniería en Informática',
		'MEC' => 'Ingeniería Mecatrónica',
		'ENE' => 'Ingeniería en Energía',
		'LYT' => 'Ingeniería en Logistíca y Transporte',
		'AMB' => 'Ingeniería en Tecnología Ambiental',
		'BMD' => 'Ingeniería Biomédica',
		'AEF' => 'Ingeniería en Animación y Efectos Visuales'
	);

	public static function crearCarreras(){
		foreach (self::$carreras as $clave => $nombre) {
			$carrera = self::create(array('clave' => $clave, 'nombre' => $nombre));
			echo "Carrera ".substr($carrera->nombre, 0, 15)."... creada\n";
		}
	}
}