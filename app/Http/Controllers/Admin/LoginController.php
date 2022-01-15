<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// ログイン忘れずにインポートすること!!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyLibrary\SetSession;
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

	//ログイン後のリダイレクト先を管理ログイン先へ
    protected $redirectTo = '/admin/home';

	/**
	 * Create a new controller instance.
	 *
	*@return void
	 */
	public function __construct()
	{
      $this->middleware('guest:admin')->except('logout'); //変更
    }

    public function showLoginForm(Request $request)
    {
        SetSession::SetCityData($request);
        SetSession::SetGenreData($request);
        return view('admin.login');  //変更
    }

    protected function guard()
    {
        return Auth::guard('admin');  //変更
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  //変更
        $request->session()->flush();
        $request->session()->regenerate();

        // return redirect(route('admin_login'));  //変更
        // ログアウトした場合にフラッシュメッセージを出す。RouteServiceProviderのconst HOME先へアクセス
        return $this->loggedOut($request) ?: redirect(route('admin_login'))->with('message', '管理者ログアウトしました。');

    }

    // Illuminate\Foundation\Auth\AuthenticatesUsersのauthenticatedメソッドを上書きしてログイン時にフラッシュメッセージを出すようにカスタマイズ
    protected function authenticated(Request $request)
    {
        // ログインした場合にフラッシュメッセージを出す。RouteServiceProviderのconst HOME先へアクセス
        return redirect(route('admin_home'))->with('message', '管理者としてログインしました。');
    }

}
