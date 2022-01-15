<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Bladeファザードを読み込む
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		/**
		 * ディレクティブ名：@invalid
		 * 説明：フォームバリデーション時、エラーになった場合にbootstrapクラス「is-invalid」追加する
		 * 引数： フォーム入力のname属性(form_name)
		 * 戻値： text「is-invalid」echoする
		 */
		Blade::directive('invalid', function ($form_name) {
			return '<?php
				if ($errors->has(' . $form_name . ')) {
					echo "is-invalid";
				} else {
					echo "";
				}
			?>';
		});
	}
}
