<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::rename('変更前のテーブル名', '変更後のテーブル名');
        // という形でテーブル名の変更を指定します。
        Schema::rename('mst_city', 'mst_cities');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('mst_cities', 'mst_city');
    }
}
