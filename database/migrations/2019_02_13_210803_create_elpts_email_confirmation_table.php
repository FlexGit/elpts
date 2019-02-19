<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsEmailConfirmationTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_email_confirmation', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->nullable();
			$table->string('code')->nullable();
			$table->dateTime('created_at')->default('now()');
			$table->smallInteger('used')->nullable()->default(0);
			$table->index(['email', 'code'], 'elpts_email_confirmation_email');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_email_confirmation');
	}
	
}
