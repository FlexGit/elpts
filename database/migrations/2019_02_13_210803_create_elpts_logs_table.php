<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsLogsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('operation_id')->nullable()->index('elpts_logs_operation_id');
			$table->integer('doc_id')->nullable();
			$table->string('user_name')->nullable()->index('elpts_logs_user_name');
			$table->timestamps();
			$table->string('value')->nullable();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_logs');
	}
	
}
