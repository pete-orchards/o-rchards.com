<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modify2IdeaThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('idea_themes', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
        });
        Schema::table('idea_theme_results', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
        });
        Schema::table('idea_theme_award_posts', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('idea_themes', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
        Schema::table('idea_theme_results', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
        Schema::table('idea_theme_award_posts', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
}
