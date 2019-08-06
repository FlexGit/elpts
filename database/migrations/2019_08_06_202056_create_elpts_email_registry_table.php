<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElptsEmailRegistryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elpts_email_registry', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->nullable();
			$table->timestamps();
			$table->index(['email'], 'elpts_email_registry_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('elpts_email_registry');
    }
}
