<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
        //引数で受け取ったデータ用の変数
        protected $contact;
    public function __construct($contact)
    {
        // 引数で受け取ったデータを疑似変数（プロパティ）にセット
        // クラス定義内部であればアクセスできる
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('テスト送信')             //メールのタイトル
                    // ->from('hoge@example.com')         //送信元。設定しない場合は.envのMAIL_FROM_ADDRESSに記載されたメールアドレスから送信される
                    ->cc('uga@example.com')             //BCCやCCの設定
                    //textメソッド → 平文テキスト版のメール　viewメソッド → HTML版のメール
                    ->view('contact.mail')              //テンプレートの呼び出し
                    ->with('contact', $this->contact)   //withオプションでセットしたデータをテンプレートへ渡す
        ;
    }
}
