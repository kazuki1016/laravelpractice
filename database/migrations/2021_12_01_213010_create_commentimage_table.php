<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentimageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_commentimage', function (Blueprint $table) {
            $table->bigIncrements('commentimage_cd')->comment('コメントに投稿された写真です。');
            $table->bigInteger('comment_cd')->comment('コメントコードです。');
            $table->string('commentimage', 100)->comment('コメント写真です。');
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
        Schema::dropIfExists('add_commentimage');
    }
}
