<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staffs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->string('name', 30);
			$table->string('position', 30);
			$table->integer('age');
			$table->string('residence', 30);
			$table->string('comment', 255);
			$table->string('good_at', 100);
			$table->timestamps();
			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade')
					->onUpdate('cascade');
		});
		Schema::create('staff_url_sites', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('staff_id');
			$table->string('name', 255);
			$table->string('img', 255);
			$table->timestamps();
		});

		Schema::create('staff_urls', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('staff_id');
			$table->unsignedBigInteger('staff_url_site_id');
			$table->string('url', 255);
			$table->timestamps();
			$table->foreign('staff_id')
					->references('id')
					->on('staffs')
					->onDelete('cascade')
					->onUpdate('cascade');
			$table->foreign('staff_url_site_id')
					->references('id')
					->on('staff_url_sites')
					->onDelete('cascade')
					->onUpdate('cascade');
		});
		Schema::create('staff_columns', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('staff_id');
			$table->string('title', 30);
			$table->string('body', 255);
			$table->timestamps();
			$table->foreign('staff_id')
					->references('id')
					->on('staffs')
					->onDelete('cascade')
					->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('staffs');
		Schema::dropIfExists('staff_urls');
		Schema::dropIfExists('staff_url_site_id');
		Schema::dropIfExists('staff_columns');
	}
}
