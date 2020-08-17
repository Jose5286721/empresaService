<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model {
	protected $fillable = [
		"dia", "hora_apertura", "hora_clausura", "empresa_id",
	];
	public function empresas() {
		return $this->belongsTo("App\Empresa");
	}
}
