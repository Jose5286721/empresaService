<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresa extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('empresas', function (Blueprint $table) {
			$table->id();
			$table->string("nombre");
			$table->unsignedBigInteger("direccion_id");
			$table->string("ruc");
			$table->text("icono");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('empresas');
	}
}
