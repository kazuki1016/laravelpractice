<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Mstshop;
// use App\Comment;
// use App\CommentImage;
use App\MyLibrary\DbRegist;
//sessionへデータを渡すために読み込み
use App\MyLibrary\SetSession;
use App\MyLibrary\DbSelect;
//ユーザー情報を取得するために読み込み
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{

	//お店登録時のファイル登録処理
	public function registImage($request)
	{
		//ファイル名を定義
		$filename = '';
		//アップロードしたファイルへアクセス
		$image = $request->file('shop_image');
		if (isset($image)) {
			$ent = $image->guessExtension();			//拡張子を取得
			$filename = uniqid("shop_") . '.' . $ent;	//ファイル名はランダムな文字列+拡張子
			$image->storeAs('shop_image', $filename, 'public');	//publicフォルダ(storage)のshop_imageに画像を格納。第3引数はstorage/app/publicの意味？
		}
		return $filename;
	}

	//一覧画面を表示する処理
	public function index(Request $request)
	{
		// dump(url()->current());
		// dd(route('top'));
		SetSession::SetCityData($request);
		SetSession::SetGenreData($request);
		$shop_data = DbSelect::searchShopByCondition($request);
		return view('shizuoka.index')->with('shop_data', $shop_data);
	}

	//マイページと登録したお店リストを表示する
	public function mypageIndex()
	{
		$shop_data = DbSelect::getMyShopData();
		return view('shizuoka.mypage')->with('shop_data', $shop_data);
	}

	//お店登録画面を表示
	public function shopRegistIndex()
	{
		return view('shizuoka.shopregistindex');
	}

	//お店登録処理
	public function shopDataInsert(Request $request)
	{
		$request->validate([
			'shop_name'		=> ['required', 'string', 'max:50'],
			'shop_image'	=> ['file', 'image', 'mimes:jpeg,png'],
			'shop_detail'	=> ['required', 'string', 'max:300'],
			'address'		=> ['max:255']
		]);



		DB::beginTransaction();
		try {
			//ファイル名の取得
			$filename = $this->registImage($request);
			//登録処理
			DbRegist::registShop($request, $filename);
			DB::commit();
			return redirect(route('mypage'))->with('message', 'お店の登録が完了しました。');
		} catch (\Throwable $th) {
			DB::rollBack();
			return redirect(route('mypage'))->with('errormessage', '登録に失敗しました。');
		}


	}

	//お店詳細を表示
	public function shopDetailIndex($shop_cd)
	{
		//お店詳細
		$shop_detail = DbSelect::getShopDetail($shop_cd);

		//コメント表示処理
		$comment_data = DbSelect::getComment($shop_cd);

		return view('shizuoka.shopdetail')->with([
			'shop_detail'	=> $shop_detail,
			'comment_data'	=> $comment_data,
			// 'stations'		=> $stations
		]);
	}

	//お店編集画面
	public function editIndex($shop_cd)
	{
		//登録してあるお店データ
		$shop_data = DbSelect::getShopDetail($shop_cd);
		return view('shizuoka.editshop')->with('shop_data', $shop_data);
	}

	//コメント登録画面
	public function commentRegistIndex($shop_cd)
	{
		return view('shizuoka.commentregistindex')->with('shop_cd', $shop_cd);
	}

	//コメント登録処理
	public function commentDataInsert(Request $request)
	{
		$request->validate([
			'comment_title'		=> ['required', 'string', 'max:20'],
			'comment_image.*'	=> ['file', 'image', 'mimes:jpeg,png'],
			'comment_body'		=> ['required', 'string', 'max:500']
		]);
		DB::beginTransaction();
		try {
			$comment_cd = DbRegist::registComment($request);
			if(isset($request->comment_image)){
				foreach ($request->comment_image as $index => $data) {
					$comment_filename = '';
					$ent = $data->guessExtension();
					$uniqid = uniqid("comment_") . '_' . Auth::id() . '_' . ($index+1);
					$comment_filename = "{$uniqid}.{$ent}";
					$data->storeAs('comment_image', $comment_filename, 'public');
					DbRegist::registCommentImage($comment_cd, $comment_filename);
				}
			}
			DB::commit();
			return redirect(route('detail', $request->shop_cd))->with('message', 'コメントを投稿しました。');
		} catch (\Throwable $th) {
			DB::rollBack();
			return redirect(route('detail', $request->shop_cd))->with('errormessage', 'コメント投稿を失敗しました。');
		}

	}

	//お店編集処理
	public function updateShopData(Request $request)
	{
		$request->validate([
			'shop_name'		=> ['required', 'string', 'max:50'],
			'shop_image'	=> ['file', 'image', 'mimes:jpeg,png'],
			'shop_detail'	=> ['required', 'string', 'max:300']
		]);

		//登録されている画像ファイルの削除〜更新完了までトランザクション
		DB::beginTransaction();
		try {
			//更新対象の画像ファイル名を取得
			$filename =	DbSelect::getShopImage($request->shop_cd);

			//アップロードしたファイルへアクセス
			$image = $request->file('shop_image');

			//ファイルがアップされたら以下の処理
			if (isset($image)) {
				//ファイルが存在したらファイルを削除
				if(Storage::disk('public')->exists('/shop_image/' . $filename)){
					Storage::disk('public')->delete('/shop_image/' . $filename);
				}
				//新しい画像ファイルをstorage/shop_imageに保管
				$ent = $image->guessExtension();
				//ファイル名を再定義
				$filename = uniqid("shop_") . '.' . $ent;
				$image->storeAs('shop_image', $filename, 'public');
			}
			DbRegist::updateShop($request, $filename);
			DB::commit();
			return redirect(route('mypage'))->with('message', 'お店情報を更新しました');
		} catch (\Throwable $th) {
			DB::rollback();
			return redirect(route('mypage'))->with('errormessage', '更新に失敗しました');
		}
	}

	//お店削除機能
	public function deleteShopData($shop_cd)
	{
		DB::beginTransaction();
		try {
			//お店のファイル名取得
			$filename = DbSelect::getShopImage($shop_cd);
			//お店の削除
			DbSelect::deleteShop($shop_cd);

			//ファイルの削除
			if(Storage::disk('public')->exists('/shop_image/' . $filename)){
				Storage::disk('public')->delete('/shop_image/' . $filename);
			}
			DB::commit();
			return redirect(route('mypage'))->with('message', 'お店を削除しました。');
		} catch (\Throwable $th) {
			DB::rollback();
			return redirect(route('mypage'))->with('errormessage', '削除に失敗しました。');
		}
	}

	//検索処理
	public function searchShop(Request $request)
	{
		$condition = $request->condition;
		$search_name = '';
		$shop_data = DbSelect::searchShopByCondition($request);

		//検索条件で検索結果の見出しを変える
		//ジャンルもしくは市町村を選択した場合、検索条件に合致した名前をセッションから取得
		switch ($condition) {
			case 'genre_cd':
				$genre_data = session('genre_data');
				$search_name = $genre_data[$request->genre_cd];
				break;
			case 'city_cd':
				$city_data = session('city_data');
				$search_name = $city_data[$request->city_cd];
				break;
			case 'shop_name':
				$search_name = $request->shop_name;
				break;
		}
		return view('shizuoka.shoplist')->with([
			'shop_data'		=> $shop_data,
			'search_name'	=> $search_name
		]);
	}
}
