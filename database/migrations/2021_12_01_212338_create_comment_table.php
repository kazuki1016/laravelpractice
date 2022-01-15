<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_comment', function (Blueprint $table) {
            $table->bigIncrements('comment_cd')->comment('コメントコードです。');
            $table->bigInteger('user_cd')->comment('登録者です。');
            $table->bigInteger('shop_cd')->comment('お店コードです。');
            $table->string('comment_title', '100')->comment('タイトルです');
            $table->string('comment_body', '2000')->comment('コメント本文です');
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
        Schema::dropIfExists('add_comment');
    }
}

