<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeaThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('bannar');
            $table->date('from');
            $table->date('to');
            $table->string('body', 1200);
            $table->string('awards', 1200);
            $table->string('tag');
            $table->softDeletes();
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
        Schema::dropIfExists('idea_themes');
    }
}
