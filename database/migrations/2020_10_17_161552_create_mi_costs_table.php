<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mi_id');
            $table->integer('num');
            $table->string('name', 20);
            $table->unsignedDecimal('amount', 10, 2);
            $table->integer('volume');
            $table->timestamps();

            $table->foreign('mi_id')
                    ->references('id')
                    ->on('mis')
                    ->onDelete('cascade');
            $table->index(['mi_id', 'num']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mi_costs');
    }
}
