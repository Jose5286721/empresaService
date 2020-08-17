<?php
namespace App\Http\Controllers;
use App\Feriado;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeriadoController extends Controller {
	use ApiResponse;
	public function __construct() {

	}
	public function index() {
		return $this->successResponse(Feriado::all());
	}
	public function show($id) {
		$feriado = Feriado::findOrFail($id);
		return $this->successResponse($feriado);
	}
	public function store(Request $request) {
		$this->validate($request, [
			"fecha" => "required|string|min:1",
			"causa" => "required|string|max:255",
		]);
		$feriado = Feriado::create($request->all());
		return $feriado;
	}
	public function update(Request $request, $id) {
		$this->validate($request, [
			"fecha" => "string|min:1",
			"causa" => "string|max:255",
		]);
		$feriado = Feriado::findOrFail($id);
		$feriado->fill($request->all());
		if ($feriado->isClean()) {
			return $this->errorResponse("Modifique al menos un valor", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		return $this->successResponse($feriado);
	}
	public function destroy($id) {
		$feriado = Feriado::findOrFail($id);
		$feriado->delete();
		return $this->successResponse($feriado);
	}
}
