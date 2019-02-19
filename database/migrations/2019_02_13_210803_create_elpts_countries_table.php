<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsCountriesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_countries', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->smallInteger('enable')->default(1)->index('elpts_countries_enable');
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_countries');
	}
	
}
