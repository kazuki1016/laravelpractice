<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 作成したメールクラスをuseする
use App\Mail\ContactMail;
use App\MyLibrary\DbRegist;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
	public function input()
	{
		return view('contact.index');
	}

	public function confirm(Request $request)
	{
		$request->validate([
			'inquirer'			=> ['required', 'string'],
			'email'				=> ['required', 'email'],
			'contact_detail'	=> ['max:1000']
		]);
		// 配列として受け取りたいのでallメソッド。こうすると$request->変数の形にする必要はなくなる;
		$data = $request->all();
		return view('contact.confirm')->with($data);
	}

	public function finish(Request $request)
	{
		// dd($request);
		//登録ボタンの場合はデータベースへの登録とメール送信
		if($request->submit === 'submit'){
			//データベースへ問い合わせ内容の登録
			DbRegist::registContact($request);
			// 全入力データをcontact変数に代入
			$contact = $request;

			// 引数にリクエストデータを渡す
			// Mailファサードを使ってメールを送信。Mail::to(送信先アドレス）になる
			Mail::to($contact->email)->send(new \App\Mail\ContactMail($contact));
			return redirect(route('top'))->with('message', 'お問合せを受け付けました。');
		}
		// 修正ボタンが押された場合入力値を保持したままお問合せ画面へ
		else{
			$data = $request->all();
			return view('contact.index')->with($data);
		}
	}
}
