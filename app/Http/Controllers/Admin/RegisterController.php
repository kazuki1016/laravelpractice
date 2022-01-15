<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Admin;									//対象モデルをUserからAdminに変更
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\MyLibrary\SetSession;

//新規登録画面カスタマイズのため、リクエストクラスをインポート
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	//管理者を新規登録する場合はguest認証をOFFにする（ログインしている管理者が登録するため）
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'], //uniqueルールの対象テーブルをadminsに変更
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9-]+$/'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

	public function showRegisterForm(Request $request)
	{
		SetSession::SetCityData($request);
		SetSession::SetGenreData($request);
		return view('admin.register');  // 管理者用テンプレート
	}

    //新規登録画面カスタマイズ。フラッシュメッセージを追加
    protected function registered()
    {
        return redirect(route('admin_home'))->with('message', '管理者登録が完了しました。');
    }

	protected function guard()
	{
		return Auth::guard('admin'); //管理者認証のguardを指定
	}
}
