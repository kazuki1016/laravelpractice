<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MyLibrary\DbSelect;
use App\MyLibrary\SetSession;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// ログイン忘れずにインポートすること!!
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

	//リダイレクト先をindexへ
    protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	*@return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

    //ログイン時にもセッションに市町村データとジャンルデータを取得する
    public function showLoginForm(Request $request)
    {
        SetSession::SetCityData($request);
        SetSession::SetGenreData($request);

        return view('auth/login');  //変更
    }

    // Illuminate\Foundation\Auth\AuthenticatesUsersのauthenticatedメソッドを上書きしてログイン時にフラッシュメッセージを出すようにカスタマイズ
    protected function authenticated(Request $request){
        // ログインした場合にフラッシュメッセージを出す。RouteServiceProviderのconst HOME先へアクセス
        return redirect(RouteServiceProvider::HOME)->with('message', 'ログインしました。');
    }

    // Illuminate\Foundation\Auth\AuthenticatesUsersのlogoutメソッドを上書きしてフラッシュメッセージを出すようにカスタマイズ
    protected function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();

        // ログアウトした場合にフラッシュメッセージを出す。RouteServiceProviderのconst HOME先へアクセス
        return $this->loggedOut($request) ?: redirect(RouteServiceProvider::HOME)->with('message', 'ログアウトしました。');
    }
}
