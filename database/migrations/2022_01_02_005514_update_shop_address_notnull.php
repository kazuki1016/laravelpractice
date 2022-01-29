<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShopAddressNotnull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_shops', function (Blueprint $table) {
            //addressのnotnull制約を解除
            $table->string('address')->nullable()->change();
            $table->string('shop_image', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Mst_shops', function (Blueprint $table) {
            //
            $table->string('address')->nullable(false)->change();
            $table->string('shop_image', 100)->nullable(false)->change();
        });
    }
}
