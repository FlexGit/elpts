<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsJunksTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_junks', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->smallInteger('enable')->default(1)->index('elpts_junks_enable');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_junks');
	}
	
}
