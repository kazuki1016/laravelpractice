<?php

namespace App\Http\Controllers;

//パスワードをハッシュ化。デフォルトの
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //ユーザー新規登録画面
    public function getSignup(){
        return view('shizuoka.user.signup');
    }
    //ユーザー新規登録確認画面
    public function confirmSignup(\App\Http\Requests\UserValidation $req){
        //バリデーション設定を全取得
        $data = $req->all();
        return view('shizuoka.user.signup_confirm')->with($data);
    }

    public function insertNewUser(Request $request){
        // dd($request);
        //戻るボタンが押されたらユーザー登録ページへリダイレクト
        if($request->has('back')){
            //withInput()でフラッシュデータに保存して入力画面に返す
            return redirect('shizuoka/signup')->withInput();
        }
         //登録処理
        \App\User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        
        return redirect()->to('shizuoka/index')->with('message', '登録が完了しました。');
    }
}
