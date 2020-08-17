<?php
namespace App\Http\Resources\Json;
use App\Empresa;
use Illuminate\Http\Resources\Json\JsonResource;

class HorarioEmpresaJson extends JsonResource {
	public function toArray($request) {
		return [
			"dia" => $this->dia,
			"hora_apertura" => $this->hora_apertura,
			"hora_clausura" => $this->hora_clausura,
			"empresa" => Empresa::findOrFail($this->empresa_id),
		];
	}
}
