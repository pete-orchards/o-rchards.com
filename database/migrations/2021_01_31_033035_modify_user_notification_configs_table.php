<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserNotificationConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_notification_configs', function (Blueprint $table) {
            $table->timestamp('mail_good')->nullable();
            $table->timestamp('mail_basket')->nullable();
            $table->timestamp('mail_reference')->nullable();
            $table->timestamp('push_good')->nullable();
            $table->timestamp('push_basket')->nullable();
            $table->timestamp('push_reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_notification_configs', function (Blueprint $table) {
            $table->dropColumn([
                'mail_good',
                'mail_basket',
                'mail_reference',
                'push_good',
                'push_basket',
                'push_reference',
            ]);
        });
     }
}
