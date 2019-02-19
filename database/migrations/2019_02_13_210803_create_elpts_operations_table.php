<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsOperationsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_operations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->smallInteger('enable')->default(1)->index('elpts_operations_enable');
			$table->integer('sort')->default(100);
			$table->integer('doctypes_id')->nullable()->index('elpts_operations_doctypes_id');
			$table->string('type')->nullable()->index('elpts_operations_type');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_operations');
	}
	
}
