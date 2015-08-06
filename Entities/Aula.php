<?php
namespace Trinity\Faker\Entities;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model{

	protected $table = 'aulas';

	public $timestamps = false;

	public $guarded = array('id');

	public function clases(){
		return $this->hasMany('Trinity\Faker\Entities\Clase', 'aula_id');
	}

	public static function crearAulas(){
		foreach (self::$aulas as $nombre) {
			if(self::where('nombre','=',$nombre)->get()->isEmpty())
				$aula = self::create(array('nombre' => $nombre));
		}
	}

	public static function disponible($horario_id, $ciclo_id){
		$ciclo = Ciclo::find($ciclo_id);
		$aula = self::whereDoesntHave('clases', function($q) use ($ciclo, $horario_id){
						$q->whereHas('grupo', function($q) use ($ciclo, $horario_id){
							$q->where('ciclo_id','=',$ciclo->id);
						})
						->where('horario_id','=',$horario_id);
					})
					->get()->random();
		return $aula;
	}

	public static $aulas = array(
		"110", "111", "112", "113", "114", "115", "116", "117", "118", "119", "120", "121", "122", "123", "124", "125", "126", "127", "128", "129", "130", "131", "132", "133", "134", "135", "136", "137", "138", "139", "140", "141", "142", "143", "144", "145", "146", "147", "148", "149", "210", "211", "212", "213", "214", "215", "216", "217", "218", "219", "220", "221", "222", "223", "224", "225", "226", "227", "228", "229", "230", "231", "232", "233", "234", "235", "236", "237", "238", "239", "240", "241", "242", "243", "244", "245", "246", "247", "248", "249", "310", "311", "312", "313", "314", "315", "316", "317", "318", "319", "320", "321", "322", "323", "324", "325", "326", "327", "328", "329", "330", "331", "332", "333", "334", "335", "336", "337", "338", "339", "410", "411", "412", "413", "414", "415", "416", "417", "418", "419", "420", "421", "422", "423", "424", "425", "426", "427", "428", "429", "430", "431", "432", "433", "434", "435", "436", "437", "438", "439"
	);
}