<?php
/**
 * Created by Aktaa.
 * User: Mohammad Aktaa
 * Date: 5/6/2018
 * Time: 4:11 AM
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTranslatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('text_en')->default('0');
			$table->string('text_ar')->default('0');
			$table->string('word')->default('0');
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
		Schema::drop('translates');
	}

}
