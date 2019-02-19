<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDocsFieldsRolesRightsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_docs_fields_roles_rights', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('docs_fields_id')->nullable()->index('elpts_docs_fields_roles_rights_docs_fields_id');
			$table->integer('roles_id')->nullable()->index('elpts_docs_fields_roles_rights_roles_id');
			$table->integer('rights_id')->nullable()->index('elpts_docs_fields_roles_rights_rights_id');
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_docs_fields_roles_rights');
	}
	
}
