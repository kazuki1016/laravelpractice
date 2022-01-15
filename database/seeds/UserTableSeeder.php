<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //今回はModelを登録していないのでDBファザードでテストデータを作成
        //データを全削除
        DB::table('users')->delete();
        //Fakerを使用
        $faker = Faker\Factory::create('ja_JP');

        //サンプルデータの挿入
        for ($i=0; $i <10 ; $i++) {
            # code...
            DB::table('users')->insert([
                [
                    'name'              => $faker->name(),
                    'email'             => $faker->email(),
                    # 「secret」でログイン 
                    'password'          => Hash::make('secret'),
                    'remember_token'    => Str::random(10),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]
            ]);
        }
    }
}
