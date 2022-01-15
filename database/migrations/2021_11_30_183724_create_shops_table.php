<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_shop', function (Blueprint $table) {
            $table->bigIncrements('shop_cd', 100)->comment('お店コードです');
            $table->string('shop_name', )->comment('お店の名前です');
            $table->string('genre_cd', 1)->comment('ジャンルコードです。1：ケーキ　2：かき氷　3：パフェ　4：アイス　5：和菓子系');
            $table->string('city_cd', 1)->comment('市町村コードです。');
            $table->bigInteger('user_cd')->comment('登録者です。');
            $table->string('shop_image', 100)->comment('お店の画像ファイル名です');
            $table->string('shop_detail', 600)->comment('お店の紹介文です');
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
        Schema::dropIfExists('mst_shop');
    }
}
