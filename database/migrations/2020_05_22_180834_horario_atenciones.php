<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HorarioAtenciones extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('horario_atencions', function (Blueprint $table) {
			$table->id();
			$table->string("dia");
			$table->time("hora_apertura");
			$table->time("hora_clausura");
			$table->unsignedBigInteger("empresa_id");
			$table->timestamps();
			$table->foreign("empresa_id")->references("id")->on("empresas");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('horario_atencions');
	}
}
