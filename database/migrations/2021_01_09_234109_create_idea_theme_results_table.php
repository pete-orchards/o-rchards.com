<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeaThemeResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_theme_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idea_theme_id');
            $table->string('banner');
            $table->string('body', 1200);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idea_theme_id')
                    ->references('id')
                    ->on('idea_themes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::create('idea_theme_award_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idea_theme_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('idea_theme_id')
                    ->references('id')
                    ->on('idea_themes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
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
        Schema::dropIfExists('idea_theme_results');
    }
}
