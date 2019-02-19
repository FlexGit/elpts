<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsTemplatesFieldsValuesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_templates_fields_values', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('templates_id')->index('elpts_templates_fields_values_templates_id');
			$table->integer('fields_id')->index('elpts_templates_fields_values_fields_id');
			$table->text('value')->nullable();
			$table->smallInteger('required')->nullable()->default(0);
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_templates_fields_values');
	}
	
}
