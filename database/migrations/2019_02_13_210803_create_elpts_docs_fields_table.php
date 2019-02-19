<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDocsFieldsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_docs_fields', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('doctypes_id')->nullable()->index('elpts_docs_fields_doctypes_id');
			$table->integer('templates_fields_id')->nullable()->index('elpts_docs_fields_templates_fields_id');
			$table->string('name')->nullable();
			$table->string('alias')->nullable();
			$table->string('type')->nullable();
			$table->string('link')->nullable();
			$table->string('mask')->nullable();
			$table->string('valid_rules')->nullable();
			$table->smallInteger('visible')->nullable()->default(1)->index('elpts_docs_fields_visible');
			$table->smallInteger('enable')->nullable()->default(1)->index('elpts_docs_fields_enable');
			$table->integer('sort')->nullable()->index('elpts_docs_fields_sort');
			$table->integer('parent_id')->nullable();
			$table->smallInteger('required')->nullable()->default(1);
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_docs_fields');
	}
	
}
