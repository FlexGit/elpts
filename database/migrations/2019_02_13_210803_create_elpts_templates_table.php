<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsTemplatesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_templates', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->integer('doctypes_id')->nullable()->index('elpts_templates_doctypes_id');
			$table->smallInteger('enable')->nullable()->default(1)->index('elpts_templates_enable');
			$table->timestamps();
			$table->smallInteger('enable_closed')->nullable()->default(1);
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_templates');
	}
	
}
