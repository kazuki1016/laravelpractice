<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 作成したメールクラスをuseする
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function input(){
        return view('contact.index');
    }

    public function confirm(Request $request){
        $data = $request->all();
        // dd($data);
        return view('contact.confirm')->with($data);
    }

    public function finish(Request $request){

        // 全入力データをcontact変数に代入
        // 配列として受け取りたい場合は $contact = $request->all();
        $contact = $request;

        // 引数にリクエストデータを渡す
        // Mailファサードを使ってメールを送信
        Mail::to($contact->email)->send(new \App\Mail\ContactMail($contact));
        return view('contact.finish');
    }
}
