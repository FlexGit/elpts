<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDocsFieldsAliasesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_docs_fields_aliases', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('templates_id')->nullable()->index('elpts_docs_fields_aliases_templates_id');
			$table->integer('docs_fields_id')->nullable()->index('elpts_docs_fields_aliases_docs_fields_id');
			$table->string('alias')->nullable();
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_docs_fields_aliases');
	}
	
}
