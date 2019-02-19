<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsSettingsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_settings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('value')->nullable();
			$table->string('unit')->nullable();
			$table->text('descr')->nullable();
			$table->text('posible_values')->nullable();
			$table->smallInteger('enable')->default(1)->index('elpts_settings_enable');
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_settings');
	}
	
}
