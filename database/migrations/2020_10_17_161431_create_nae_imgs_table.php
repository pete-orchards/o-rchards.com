<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaeImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nae_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nae_id');
            $table->integer('num');
            $table->string('img');
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
        Schema::dropIfExists('nae_imgs');
    }
}
