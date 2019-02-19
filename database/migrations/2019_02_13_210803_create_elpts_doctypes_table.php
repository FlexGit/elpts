<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDoctypesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_doctypes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->smallInteger('enable')->default(1)->index('elpts_doctypes_enable');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_doctypes');
	}
	
}
