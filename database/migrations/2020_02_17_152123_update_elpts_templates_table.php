<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateElptsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('elpts_templates', function($table) {
			$table->smallInteger('no_accept')->default(0);
			$table->index('no_accept');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('elpts_templates', function($table) {
			$table->dropColumn('no_accept');
			$table->dropIndex('no_accept');
		});
    }
}
