<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsTemplatesFieldsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_templates_fields', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('doctypes_id')->nullable()->index('elpts_templates_fields_doctypes_id');
			$table->integer('parent_id')->nullable()->index('elpts_templates_fields_parent_id');
			$table->string('name')->nullable();
			$table->string('short_name')->nullable();
			$table->string('type')->nullable();
			$table->string('link')->nullable();
			$table->smallInteger('required')->nullable();
			$table->smallInteger('enable')->nullable()->default(1)->index('elpts_templates_fields_enable');
			$table->integer('sort')->nullable()->default(100);
			$table->string('valid_rules')->nullable();
			$table->smallInteger('visible')->nullable()->default(1);
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_templates_fields');
	}
	
}
