<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsDocsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_docs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('number')->nullable();
			$table->string('prefix_number')->nullable()->index('elpts_docs_prefix_number');
			$table->binary('file')->nullable();
			$table->binary('file_base64')->nullable();
			$table->binary('file_sign')->nullable();
			$table->integer('templates_id')->nullable()->index('elpts_docs_templates_id');
			$table->integer('doctypes_id')->nullable()->index('elpts_docs_doctypes_id');
			$table->integer('prefix_id')->nullable();
			$table->integer('status_id')->nullable()->default(0)->index('elpts_docs_status_id');
			$table->text('comment')->nullable();
			$table->string('snils')->nullable();
			$table->string('fullname')->nullable();
			$table->string('position')->nullable();
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_docs');
	}
	
}
