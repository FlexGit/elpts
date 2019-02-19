<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsRolesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->integer('sort')->default(100);
			$table->integer('doctypes_id')->nullable()->index('elpts_roles_doctypes_id');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_roles');
	}
	
}
