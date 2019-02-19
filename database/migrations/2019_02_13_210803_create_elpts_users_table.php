<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsUsersTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('snils');
			$table->string('ogrn');
			$table->smallInteger('admin')->default(0);
			$table->smallInteger('enable')->default(1);
			$table->timestamps();
			$table->dateTime('auth_at')->nullable();
			$table->index(['ogrn', 'snils', 'enable'], 'elpts_users_idx');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_users');
	}
	
}
