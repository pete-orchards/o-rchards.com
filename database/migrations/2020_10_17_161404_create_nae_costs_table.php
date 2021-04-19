<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaeCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nae_costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nae_id');
            $table->integer('num');
            $table->string('name', 20);
            $table->unsignedDecimal('amount', 10, 2);
            $table->integer('volume');
            $table->timestamps();

            $table->foreign('nae_id')
                    ->references('id')
                    ->on('naes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->index(['nae_id', 'num']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nae_costs');
    }
}
