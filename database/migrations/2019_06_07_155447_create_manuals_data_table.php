<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Langs;

class CreateManualsDataTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('manuals_data', function (Blueprint $table) {
						$table->increments('id');
						$table->integer('manual_id')->default(0);

						$langs = Langs::all();
						foreach ($langs as $lang) { $table->string('title_' . $lang->key)->nullable(); }

						$table->timestamps();
				});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::dropIfExists('manuals_data');
		}
}
