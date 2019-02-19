<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElptsPrefixesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('elpts_prefixes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('doctypes_id')->index('elpts_prefixes_doctypes_id');
			$table->smallInteger('enable')->default(1)->index('elpts_prefixes_enable');
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('elpts_prefixes');
	}
	
}
