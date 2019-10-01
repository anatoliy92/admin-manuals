<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColManualsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('manuals_data', function (Blueprint $table) {
				$table->integer('good')->default(0)->after('id');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			Schema::table('manuals_data', function (Blueprint $table) {
				$table->dropColumn('good');
			});
    }
}
