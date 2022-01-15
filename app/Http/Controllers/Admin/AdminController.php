<?php

namespace App\Http\Controllers\Admin;  // Adminを追加

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyLibrary\DbSelect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	//管理者以外はアクセス不可に設定
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

	 //お店管理
    public function index(Request $request)
    {
        $shop_data = DbSelect::searchShopByAdmin($request);
        return view('admin.home')->with([
			'shop_data'	=> $shop_data,
		]);
    }

	//お店削除
	public function deleteShopAdmin(Request $request)
	{
		// dd($request->delete);
		$targetShops = $request->delete;
		DB::beginTransaction();
		try {
			//お店のファイル名取得
			foreach ($targetShops as $targetShop) {
				$filename = DbSelect::getShopImage($targetShop);
				//お店の削除
				DbSelect::deleteShop($targetShop);
				//ファイルの削除
				if (Storage::disk('public')->exists('/shop_image/' . $filename)) {
					Storage::disk('public')->delete('/shop_image/' . $filename);
				}
			}
			DB::commit();
			return redirect(route('admin_home'))->with('message', 'お店を削除しました。');
		} catch (\Throwable $th) {
			DB::rollback();
			return redirect(route('admin_home'))->with('errormessage', '削除に失敗しました。');
		}
	}
}
