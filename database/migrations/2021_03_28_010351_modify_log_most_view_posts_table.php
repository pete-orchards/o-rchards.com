<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLogMostViewPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_most_view_posts', function (Blueprint $table) {
            $table->date('logged_at')->default(NULL)->change();
        });
        Schema::table('log_most_view_tanes', function (Blueprint $table) {
            $table->date('logged_at')->default(NULL)->change();
        });
        Schema::table('log_most_view_naes', function (Blueprint $table) {
            $table->date('logged_at')->default(NULL)->change();
        });
        Schema::table('log_most_view_mis', function (Blueprint $table) {
            $table->date('logged_at')->default(NULL)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_most_view_posts', function (Blueprint $table) {
            $table->timestamp('logged_at')->change();
        });
        Schema::table('log_most_view_tanes', function (Blueprint $table) {
            $table->timestamp('logged_at')->change();
        });
        Schema::table('log_most_view_naes', function (Blueprint $table) {
            $table->timestamp('logged_at')->change();
        });
        Schema::table('log_most_view_mis', function (Blueprint $table) {
            $table->timestamp('logged_at')->change();
        });
    }
}
