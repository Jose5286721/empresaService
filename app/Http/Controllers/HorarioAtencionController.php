<?php
namespace App\Http\Controllers;
use App\Feriado;
use App\HorarioAtencion;
use App\Http\Resources\Json\HorarioEmpresaJson;
use App\Http\Resources\Json\HorarioJson;
use App\Traits\ApiResponse;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HorarioAtencionController extends Controller {
	use ApiResponse;
	public function index() {
		return $this->successResponse(HorarioAtencion::all());
	}
	public function store(Request $request) {
		$this->validate($request, [
			"dia" => "required|string|min:1",
			"hora_apertura" => "required|string|min:1",
			"hora_clausura" => "required|string|min:1",
			"empresa_id" => "required|string|min:1",
		]);
		$horarioAtencion = HorarioAtencion::create($request->all());
		return $this->successResponse($horarioAtencion);
	}
	public function showEmpresasAbiertas() {
		$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Feriado");
		$timeZone = "America/Asuncion";
		$dateTime = new DateTime("now", new DateTimeZone($timeZone));
		$dateTime->setTimestamp(time());
		$dia = $dateTime->format("Y-m-d");
		$hora = $dateTime->format("H:i");
		$esFeriado = Feriado::where("fecha", $dia)->count();
		if ($esFeriado < 1) {
			$horarioAtencion = HorarioAtencion::where("hora_apertura", "<=", $hora)->where("dia", $dias[date("w")])->where("hora_clausura", ">=", $hora)->get();
			return HorarioJson::collection($horarioAtencion);
		} else {
			$horarioAtencion = HorarioAtencion::where("hora_apertura", "<=", $hora)->where("dia", $dias[7])->where("hora_clausura", ">=", $hora)->get();
			return HorarioJson::collection($horarioAtencion);
		}

	}
	public function showByIdDiaSemanaAndIdEmpresa(Request $request, $idEmpresa) {
		$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
		$timeZone = "America/Asuncion";
		$dateTime = new DateTime("now", new DateTimeZone($timeZone));
		$dateTime->setTimestamp(time());
		$dia = $dateTime->format("d-m-Y");
		$hora = $dateTime->format("H:i");
		$horarioAtencion = HorarioAtencion::where("dia", $dias[date("w")])->where("empresa_id", $idEmpresa)->first();
		return new HorarioEmpresaJson($horarioAtencion);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			"hora_apertura" => "required|string|min:1",
			"hora_clausura" => "required|string|min:1",
			"empresa_id" => "required|string|min:1",
		]);
		$horarioAtencion = HorarioAtencion::findOrFail($id);
		$horarioAtencion->fill($request->all());
		if ($horarioAtencion->isClean()) {
			return $this->errorResponse("Al menos un valor debe ser modificado", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$horarioAtencion->save();
		return $this->successResponse($horarioAtencion);
	}
	public function show($id) {
		$horarioAtencion = HorarioAtencion::findOrFail($id);
		return $this->successResponse($horarioAtencion);
	}
	public function destroy($id) {
		$horarioAtencion = HorarioAtencion::findOrFail($id);
		$horarioAtencion->delete();
		return $this->successResponse($horarioAtencion);
	}
}
