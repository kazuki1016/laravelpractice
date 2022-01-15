<?php

namespace App\MyLibrary;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mstshop;
use App\Comment;
use App\CommentImage;

class DbRegist
{
	//お店登録処理
	public static function registShop($request, $filename)
	{
		MstShop::create([
			'shop_name'		=> $request->shop_name,
			'genre_cd'		=> $request->genre_cd,
			'city_cd'		=> $request->city_cd,
			'user_cd'		=> Auth::id(),
			'shop_image'	=> $filename,
			'shop_detail'	=> $request->shop_detail,
			'address'		=> $request->address
		]);
	}

	//commentテーブルへのinsertとcomment_cdの取得。insertGetIdだと自動的にcreated_atとupdated_atに登録時刻が入らないので自分で指定
	public static function registComment($request)
	{
		$comment_cd = Comment::insertGetId(
			[
				'user_cd'			=> Auth::id(),
				'comment_title'		=> $request->comment_title,
				'shop_cd'			=> $request->shop_cd,
				'comment_body'		=> $request->comment_body,
				'created_at'		=> now(),
				'updated_at'		=> now()
			],
			'comment_cd'
		);
		return $comment_cd;
	}

	//commentimageの登録
	public static function registCommentImage($comment_cd, $comment_filename)
	{
		CommentImage::create([
			'comment_cd'	=> $comment_cd,
			'commentimage'	=> $comment_filename
		]);
	}
	//お店の更新処理
	public static function updateShop($request, $filename)
	{
		DB::table('Mst_shops')
		->where('shop_cd', $request->shop_cd)
			->update([
				'shop_name'		=> $request->shop_name,
				'genre_cd'		=> $request->genre_cd,
				'city_cd'		=> $request->city_cd,
				'shop_image'	=> $filename,
				'address'		=> $request->address,
				'shop_detail'	=> $request->shop_detail,
				'updated_at'	=> now()
			]);
	}

}
