<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsOwnersTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_owners', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->smallInteger('enable')->default(1)->index('elpts_owners_enable');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_owners');
	}
	
}
