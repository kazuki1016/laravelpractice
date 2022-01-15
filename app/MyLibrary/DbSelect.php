<?php

namespace App\MyLibrary;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mstshop;
use App\Comment;
use App\CommentImage;

class DbSelect
{

	//ユーザーが登録したお店を取得するselect文
	static public function getMyShopData()
	{
		$shop_data = MstShop::select([
			'sh.shop_cd',
			'sh.shop_name',
			'sh.city_cd',
			'ci.city_name',
			'sh.genre_cd',
			'ge.genre_name',
			'sh.shop_detail',
			'sh.shop_image'
		])
			->from('Mst_shops as sh')
			->leftjoin('mst_cities as ci', function ($join) {
				$join->on('ci.city_cd', '=', 'sh.city_cd');
			})
			->leftjoin('mst_genres as ge', function ($join) {
				$join->on('ge.genre_cd', '=', 'sh.genre_cd');
			})
			->when(Auth::user()->name !== 'Admin', function($q){
				$q->where('user_cd', Auth::id());
			})
			->orderBy('sh.shop_cd', 'asc')
			->get();
		return $shop_data;
	}

	//お店詳細を取得するselect文
	static public function getShopDetail($shop_cd)
	{
		//クエリビルダー
		$shop_detail = DB::table('Mst_shops')
			->from('Mst_shops as sh')
			->leftjoin('mst_cities as ci', function ($join) {
				$join->on('ci.city_cd', '=', 'sh.city_cd');
			})
			->leftjoin('mst_genres as ge', function ($join) {
				$join->on('ge.genre_cd', '=', 'sh.genre_cd');
			})
			->where('sh.shop_cd', $shop_cd)
			->first();
			//1件のデータ取得なのでgetではなくfirstメソッドで返した方がbladeでforeachしなくていい
			// ->get();
		return $shop_detail;
	}

	//お店更新時に写真を取得するselect文
	static public function getShopImage($shop_cd)
	{
		$filename = DB::table('Mst_shops')
						->where('shop_cd', $shop_cd)
						->value('shop_image');
		return $filename;
	}

	//お店のコメントを取得
	static public function getComment($shop_cd)
	{
		//コメントと写真をviewに渡すために種々配列を定義
		$comment_data = [];		//キーをcomment_cdとしたコメントデータを持つ配列
		$image_data = [];		//キーをcomment_cdとして画像をまとめた配列
		$comment_cds = [];		//comment_cdを配列にしてコメント写真のIN句に渡すための配列

		$comments = Comment::select([
				'cmt.comment_cd',
				'cmt.comment_title',
				'cmt.comment_body',
				'cmt.created_at as comment_date',
				'usr.name'
			])
			->from('Comments as cmt')
			->leftJoin('Users as usr', function($join){
				$join->on('usr.id', '=', 'cmt.user_cd');
			})
			->where('cmt.shop_cd', $shop_cd)
			->orderBy('cmt.comment_cd', 'asc')
			->get()
			->toArray();

		// dump($comments);

		//配列を加工する
		foreach ($comments as $comment) {
			//DBから取得したデータをキー＝comment_cdにして扱いやすいデータにする。
			$comment_data[$comment['comment_cd']] = [
				'comment_title'		=> $comment['comment_title'],
				'comment_body'		=> $comment['comment_body'],
				'comment_date'		=> $comment['comment_date'],
				'user_name'			=> $comment['name']
			];
			//comment_cdを配列にしてコメント写真のIN句に渡す
			$comment_cds[] = $comment['comment_cd'];
		}

		// dump($comment_data);

		$comment_images = CommentImage::select([
				'cim.comment_cd',
				'cim.commentimage'
			])
			->from('Comment_images as cim')
			->leftJoin('Comments as cmt', function($join){
				$join->on('cmt.comment_cd', '=', 'cim.comment_cd');
			})
			->whereIn('cim.comment_cd', $comment_cds)
			->orderBy('cim.comment_cd', 'asc')
			->get()
			->toArray();

		// dump($comment_images);

		//comment_cd毎にcommentimageをまとめる。
		foreach ($comment_images as $image) {
			$image_data[$image['comment_cd']] [] = $image['commentimage'];
		}

		// dump($image_data);

		//comment_dataとimage_dataでキーが一致するならcomment_dataに追加する。
		foreach ($image_data as $comment_cd => $images) {
			if(array_key_exists($comment_cd, $comment_data)){
				foreach ($images as $image) {
					$comment_data[$comment_cd]['commentimage'][] = $image;
				}
			}
		}
		// dd($comment_data);

		return $comment_data;
	}

	static public function deleteShop($shop_cd)
	{
		Mstshop::where('shop_cd', $shop_cd)->delete();
	}

	//お店を検索するメソッド。
	static public function searchShopByCondition($request)
	{
		$search_value = '';
		$condition = $request->condition;
		if(isset($request->genre_cd)){
			$search_value = $request->genre_cd;
		} else if (isset($request->city_cd)){
			$search_value = $request->city_cd;
		} else {
			$search_value = $request->shop_name;
		}

		//where句までのSQL文の組み立て
		$query = MstShop::
		select([
			'sh.shop_cd',
			'sh.shop_name',
			'sh.city_cd',
			'ci.city_name',
			'sh.genre_cd',
			'ge.genre_name',
			'sh.shop_detail',
			'sh.shop_image'
		])
		->from('Mst_shops as sh')
		->leftjoin('mst_cities as ci', function ($join) {
			$join->on('ci.city_cd', '=', 'sh.city_cd');
		})
		->leftjoin('mst_genres as ge', function ($join) {
			$join->on('ge.genre_cd', '=', 'sh.genre_cd');
		});
		// ->orderBy('sh.shop_cd', 'asc');

		//何で検索したがでwhere句を変える
		switch ($condition) {
			case 'genre_cd':
				$query->where('sh.genre_cd', $search_value);
				break;
			case 'city_cd':
				$query->where('sh.city_cd', $search_value);
				break;
			case 'shop_name':
				$query->where('sh.shop_name', 'like', "%{$search_value}%");
				break;
			case 'top':
				break;
			default: 	//topに表示する最新の3件
				$query->orderBy('sh.shop_cd', 'desc');
				$query->limit(3);
		}
		//組み立てたSQL文の実行
		return $query->get();
	}

	//管理者用のお店一覧。
	static public function searchShopByAdmin($request)
	{
		// dump($request);

		//初回時アクセス時に値をセット
		if(!isset($request->shop_name)){
			$request->shop_name = '';
		}

		if(!isset($request->genre_cd)){
			$request->genre_cd = 'A';
		}

		if(!isset($request->city_cd)){
			$request->city_cd = 'A';
		}

		//検索条件を格納
		$reqParam = [
			'shop_name'	=> $request->shop_name,
			'genre_cd'	=> $request->genre_cd,
			'city_cd'	=> $request->city_cd
		];

		// dd($reqParam);

		//sessionに格納
		session(['reqParam' => $reqParam]);

		$query = Mstshop::select([
			'sh.shop_cd',
			'sh.shop_name',
			'sh.city_cd',
			'ci.city_name',
			'sh.genre_cd',
			'ge.genre_name',
			'us.id as user_cd',
			'us.name as user_name',
			'sh.created_at',
			'sh.updated_at'
		])
			->from('mst_shops as sh')
			->leftjoin('mst_cities as ci', function ($join) {
				$join->on('ci.city_cd', '=', 'sh.city_cd');
			})
			->leftjoin('mst_genres as ge', function ($join) {
				$join->on('ge.genre_cd', '=', 'sh.genre_cd');
			})
			->leftjoin('users as us', function ($join) {
				$join->on('us.id', '=', 'sh.user_cd');
			})
			->orderBy('sh.shop_cd');

		//お店の名前が空でないなら店名で曖昧検索
		if(!empty($reqParam['shop_name'])){
			$query->where('sh.shop_name', 'like', "%{$reqParam['shop_name']}%");
		}

		//ジャンルが「全て」でないならジャンルで検索
		if(!($reqParam['genre_cd'] === 'A')){
			$query->where('sh.genre_cd', $reqParam['genre_cd']);
		}

		//市町村が「全て」でないなら市町村で検索
		if(!($reqParam['city_cd'] === 'A')){
			$query->where('sh.city_cd', $reqParam['city_cd']);
		}

		//組み立てたクエリーの実行。1000件毎に表示
		return $query->paginate(1000);
	}
}
