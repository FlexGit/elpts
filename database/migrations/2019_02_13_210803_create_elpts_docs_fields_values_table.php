<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDocsFieldsValuesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_docs_fields_values', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('docs_id')->index('elpts_docs_fields_values_docs_id');
			$table->integer('fields_id')->index('elpts_docs_fields_values_fields_id');
			$table->text('value')->nullable();
			$table->integer('status_id')->nullable();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_docs_fields_values');
	}
	
}
