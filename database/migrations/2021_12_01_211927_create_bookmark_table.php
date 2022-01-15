<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_bookmark', function (Blueprint $table) {
            $table->bigIncrements('bookmark_id')->comment('ブックマークコードです');
            $table->bigInteger('user_cd')->comment('登録者です。');
            $table->bigInteger('shop_cd')->comment('お店コードです。');
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
        Schema::dropIfExists('add_bookmark');
    }
}
