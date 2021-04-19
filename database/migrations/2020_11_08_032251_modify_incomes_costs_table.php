<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIncomesCostsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nae_incomes', function (Blueprint $table) {
			$table->integer('amount')->change();
			$table->unsignedDecimal('volume', 10, 2)->change();
		});
		Schema::table('nae_costs', function (Blueprint $table) {
			$table->integer('amount')->change();
			$table->unsignedDecimal('volume', 10, 2)->change();
		});
		Schema::table('mi_incomes', function (Blueprint $table) {
			$table->integer('amount')->change();
			$table->unsignedDecimal('volume', 10, 2)->change();
		});
		Schema::table('mi_costs', function (Blueprint $table) {
			$table->integer('amount')->change();
			$table->unsignedDecimal('volume', 10, 2)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nae_incomes', function (Blueprint $table) {
			$table->integer('volume')->change();
			$table->unsignedDecimal('amount', 10, 2)->change();
		});
		Schema::table('nae_costs', function (Blueprint $table) {
			$table->integer('volume')->change();
			$table->unsignedDecimal('amount', 10, 2)->change();
		});
		Schema::table('mi_incomes', function (Blueprint $table) {
			$table->integer('volume')->change();
			$table->unsignedDecimal('amount', 10, 2)->change();
		});
		Schema::table('mi_costs', function (Blueprint $table) {
			$table->integer('volume')->change();
			$table->unsignedDecimal('amount', 10, 2)->change();
		});
	}
}
