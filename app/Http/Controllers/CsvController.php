<?php

namespace App\Http\Controllers;

use App\MstCity;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;
// use PhpParser\Lexer;
use Goodby\CSV\Import\Standard\Lexer;

class CsvController extends Controller
{
    //取り込み画面の表示
    public function index(){
        return view('csvimport.import_index');
    }

    public function import(Request $request){
        //postデータにファイルが存在しているかつ問題なくアップロードできているか
        if($request->hasFile('csvfile') && $request->file('csvfile')->isValid()){
            //一時的なファイル名を作成。guessExtension()は拡張子を取得
            $tmpname = uniqid("CSVUP_") . "." . $request->file('csvfile')->guessExtension();
            //public/csv/tmpフォルダに移動
            $request->file('csvfile')->move(public_path()."/csv/tmp", $tmpname);
            //ファイルのパスを取得
            $tmppath = public_path(). "/csv/tmp/" . $tmpname;

            //Goodby CSVの設定
            $config_in = new LexerConfig();

            //文字コードをSJISからUTF-8へ変換。読み取り時にヘッダーを無視する。
            $config_in->setFromCharset("sjis-win");
            $config_in->setToCharset("UTF-8");
            $config_in->setIgnoreHeaderLine(true);

            $lexer_in = new Lexer($config_in);
            $datalist = array();
            $interpreter = new Interpreter();
            $interpreter->addObserver(function (array $row) use (&$datalist){
                //各行のデータを取得
                $datalist[] = $row;
            });
            //csvファイルをパース
            $lexer_in->parse($tmppath, $interpreter);

            //TMPファイルを削除
            unlink($tmppath);

            //登録処理
            $count = 0;
            foreach($datalist as $row){
                // dd($row[0]);
                \App\MstCity::create([
                    'city_name' => $row[0]
                ]);
                $count ++;
            }
            return redirect()->to('/csv/index')->with('flashmessage', 'csvデータを登録しました。登録件数：' . $count);
        }
        return redirect()->to('/csv/index')->with('flashmessage', 'csvデータ登録に失敗しました。');
    }
}
