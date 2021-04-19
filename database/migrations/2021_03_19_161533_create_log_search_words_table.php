<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogSearchWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_search_words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('logged_at');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('keywords')->nullable();
            $table->string('types')->nullable();
            $table->string('remote_addr')->nullable();
            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_search_words');
    }
}
