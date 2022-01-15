<?php

namespace App\MyLibrary;

//サイトを開いた際にセッションへ格納するクラス
class SetSession
{
	//DBから市町村リストを取得するメソッド
	static public function SetCityData($request)
	{
		//セッションにデータがない場合のみ適用
		if (!($request->session()->has('city_data'))) {
			//セッション登録用の空の配列を定義
			$session_city_data = [];
			//DBから市町村リストを呼び出す
			$city_data = \App\MstCity::select('city_cd', 'city_name')->get()->toArray();
			// dump($city_data);
			foreach ($city_data as $data) {
				$session_city_data[$data['city_cd']] = $data['city_name'];
			}
			session(['city_data' => $session_city_data]);
		}
	}

	//DBからジャンルリストを取得するメソッド
	static public function SetGenreData($request)
	{
		//セッションにデータがない場合のみ適用
		if (!($request->session()->has('genre_data'))) {
			//セッション登録用の空の配列を定義
			$session_genre_data = [];
			//DBから市町村リストを呼び出す
			$genre_data = \App\Mstgenre::select('genre_cd', 'genre_name')->get()->toArray();
			foreach ($genre_data as $data) {
				$session_genre_data[$data['genre_cd']] = $data['genre_name'];
			}
			// dd($genre_data);

			session(['genre_data' => $session_genre_data]);
		}
	}
}
