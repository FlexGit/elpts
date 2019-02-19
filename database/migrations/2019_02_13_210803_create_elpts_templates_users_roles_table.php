<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsTemplatesUsersRolesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_templates_users_roles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('templates_id')->nullable();
			$table->integer('users_id')->nullable()->index('elpts_templates_users_roles_users_id');
			$table->integer('roles_id')->nullable();
			$table->integer('enable')->default(0)->index('elpts_templates_users_roles_enable');
			$table->unique(['templates_id', 'users_id', 'roles_id'], 'elpts_templates_users_roles_templates_id');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_templates_users_roles');
	}
	
}
