<?php
namespace App\Http\Controllers;
use App\Empresa;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpresaController extends Controller {

	use ApiResponse;

	public function index() {
		return Empresa::all();
	}
	public function show($id) {
		$empresa = Empresa::findOrFail($id);
		return $this->successResponse($empresa);
	}
	public function store(Request $request) {
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"direccion_id" => "required|min:1",
			"ruc" => "required|max:50|string",
			"icono" => "required|string",
		]);
		$empresa = Empresa::create($request->all());
		return $this->successResponse($empresa, Response::HTTP_CREATED);
	}
}
