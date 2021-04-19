<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mi_id');
            $table->integer('num');
            $table->string('img');
            $table->timestamps();

            $table->foreign('mi_id')
                    ->references('id')
                    ->on('mis')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('mi_imgs');
    }
}
