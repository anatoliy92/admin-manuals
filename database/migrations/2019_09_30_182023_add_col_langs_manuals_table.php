<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColLangsManualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('manuals', function (Blueprint $table) {
				$table->renameColumn('title', 'title_ru');
				$table->string('title_kz')->nullable()->after('title_ru');
				$table->string('title_en')->nullable()->after('title_kz');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			Schema::table('manuals', function (Blueprint $table) {
				$table->renameColumn('title_ru', 'title');
				$table->dropColumn('title_kz');
				$table->dropColumn('title_en');
			});
    }
}
