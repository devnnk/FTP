<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyTimersTable extends Migration
{
    public function up()
    {
        Schema::connection('mongodb')->create('reply_timers', function (Blueprint $table) {
            $table->index('id');
            //base64
            $table->index('_cmt');
            $table->string('code_event');
            $table->string('m_page_user_id');
            $table->integer('amount');
            $table->integer('timestamp_start');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('reply_timers');
    }
}
