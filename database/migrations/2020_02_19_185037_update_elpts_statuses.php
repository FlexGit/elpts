<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateElptsStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('elpts_statuses', function($table) {
			$table->text('notification_email')->nullable();
			$table->text('notification_text')->nullable();
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
		Schema::table('elpts_statuses', function($table) {
			$table->dropColumn('notification_email');
			$table->dropColumn('notification_text');
		});
    }
}
