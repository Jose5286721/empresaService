<?php
namespace App\Http\Resources\Json;
use App\Empresa;
use Illuminate\Http\Resources\Json\JsonResource;

class HorarioJson extends JsonResource {
	public function toArray($request) {
		return [
			"empresa" => Empresa::findOrFail($this->empresa_id),
		];
	}
}
