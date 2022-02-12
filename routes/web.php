<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\CsvController;
use App\Http\Controllers\IndexController;
// use Illuminate\Routing\Route;
//なぜか新しいコントローラーを生成したら動かなくなった。
use vendor\laravel\framework\src\Illuminate\Routing;
use Illuminate\Routing\RouteGroup;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('contact/', 'ContactController@input')->name('contact');
Route::patch('contact/', 'ContactController@confirm');
Route::post('contact/', 'ContactController@finish');

Route::get('csv/index', 'CsvController@index');     //csv取り込み画面
Route::post('csv/index', 'CsvController@import');   //csv取り込み処理

//ログイン処理
Auth::routes();

//各画面のルーティングを設定。認証不要
Route::group(['prefix' => 'shizuoka'], function(){
	Route::get('index', 'IndexController@index')->name('top');											//一覧画面表示
	Route::get('detail/{id}', 'IndexController@shopDetailIndex')->name('detail');			//お店詳細
	Route::get('search', 'IndexController@searchShop')->name('search');						//お店検索機能
});

//user認証必要
Route::group(['prefix' => 'shizuoka', 'middleware' => 'auth:user'], function(){
	Route::get('mypage', 'IndexController@mypageIndex')->name('mypage');					//マイページ画面
	Route::get('add', 'IndexController@shopRegistIndex')->name('shop_regist');				//お店登録画面
	Route::post('add', 'IndexController@shopDataInsert');									//お店登録処理
	Route::get('edit/{id}', 'IndexController@editIndex')->name('edit');						//お店編集
	Route::post('edit/{id}', 'IndexController@updateShopData');								//お店編集処理
	Route::post('delete/{id}', 'IndexController@deleteShopData')->name('delete');			//お店削除処理
	Route::get('comment/{id}', 'IndexController@commentRegistIndex')->name('comment');		//コメント登録画面
	Route::post('comment/{id}', 'IndexController@commentDataInsert');						//コメント登録処理
});

//admin認証必要。新規管理者登録時も管理者しか実施できないようにする
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
	Route::get('home', 'Admin\AdminController@index')->name('admin_home');
	Route::post('delete', 'Admin\AdminController@deleteShopAdmin')->name('admin_delete');	//管理者用お店削除機能

	Route::post('logout', 'Admin\LoginController@logout')->name('admin_logout');
	Route::get('register', 'Admin\RegisterController@showRegisterForm')->name('admin_register');
	Route::post('register', 'Admin\RegisterController@register')->name('admin_register');
});

//admin認証不要。ログイン画面を表示するルーティング。
Route::group(['prefix' => 'admin'], function(){
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin_login');
	Route::post('login', 'Admin\LoginController@login')->name('admin_login');
});
