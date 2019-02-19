<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsOkopfsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_okopfs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->smallInteger('enable')->default(1)->index('elpts_okopfs_enable');
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_okopfs');
	}
	
}
