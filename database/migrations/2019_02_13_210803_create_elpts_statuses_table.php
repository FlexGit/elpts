<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsStatusesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_statuses', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->smallInteger('enable')->default(1)->index('elpts_statuses_enable');
			$table->integer('sort')->default(100);
			$table->integer('doctypes_id')->nullable()->index('elpts_statuses_doctypes_id');
			$table->string('color')->nullable()->default('#ffffff');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_statuses');
	}
	
}
