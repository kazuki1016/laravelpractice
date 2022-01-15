<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_shop', function (Blueprint $table) {
            //genre_cdとcity_cdの桁数を変更
            $table->string('genre_cd', 10)->change();
            $table->string('city_cd', 10)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_shop', function (Blueprint $table) {
            //
            $table->string('genre_cd')->change();
            $table->string('city_cd')->change();
        });
    }
}
