<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopTableAddAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //既に登録しているお店の住所をDBへ一括挿入
        DB::table('mst_shops')->where('shop_cd', 3)->update(['address' => '掛川市板沢５１０−５']);
        DB::table('mst_shops')->where('shop_cd', 2)->update(['address' => '焼津市西小川６丁目５−１']);
        DB::table('mst_shops')->where('shop_cd', 1)->update(['address' => '藤枝市内瀬戸141-1']);
    }
}
