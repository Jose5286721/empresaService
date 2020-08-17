<?php

use App\Empresa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call('UsersTableSeeder');
		factory(Empresa::class, 10)->create();
	}
}
