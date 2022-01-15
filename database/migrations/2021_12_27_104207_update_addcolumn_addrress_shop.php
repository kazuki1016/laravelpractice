<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddcolumnAddrressShop extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mst_shops', function (Blueprint $table) {
			//住所カラムを追加
			$table->string('address')->comment('お店の住所です。google mapを表示するために使用します。')->after('shop_detail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mst_shops', function (Blueprint $table) {
			//住所カラムを削除
			$table->dropColumn('address');
		});
	}
}
