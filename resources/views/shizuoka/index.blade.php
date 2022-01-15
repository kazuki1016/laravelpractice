@extends('layouts.master_shizuoka')
@section('title', '抹茶の世界へようこそ')
@section('content')
	{{-- <div class ="jumbotron">
		<h1>〜ようこそ,みんなで作る静岡の抹茶の世界へ〜</h1> --}}
	{{-- </div> --}}
	<div class="container mb-5">
		<div class="row mt-2 mb-2">
			<div class="col-3 border rounded border-dark text-center">
				<div class="mx-auto">
					{{-- 認証されていれば認ユーザー名を、そうでなければゲストと表示する --}}
					@if (Auth::check())
						<p class="p-1 mb-1 text-dark"> ようこそ、{{ Auth::user()->name }}さん。</p>
					@else
					<p class="p-1 mb-1 text-dark"> ようこそ、ゲストさん。</p>
					@endif
					{{-- 上記と同じ意味 --}}
					@guest
						<p class="p-1 mt-2 mb-2 bg-info rounded-pill text-dark"> 会員の方はこちら👇</p>
						<div class="action_button">
							<a class="btn btn-dark" href="{{ route('login') }}" role="button" >ログイン</a>
						</div>
						<p class="p-1 mt-2 mb-2 bg-info rounded-pill text-dark"> 新規の方はこちら👇</p>
						<div class="action_button">
							<a class="btn btn-secondary" href="{{ route('register') }}" role="button" >新規登録</a>
						</div>
					@else
						<div class="action_button">
							<a class="btn btn-success" href="{{ route('mypage') }}" role="button" >マイページへ</a>
						</div>
					@endguest
				</div>
				<div class="mx-auto">
					<h6 class="mt-3 mb-3 text-dark"">お店を探す⬇️</h6>
					<h6>ジャンルから探す</h6>
					<div>
						<form method="GET" action="{{ route('search', 'genre_cd') }}"  target="_blank">
							<select name="genre_cd" class="form-control">
								<option disabled selected>選択してください</option>
								@foreach (session('genre_data') as $genre_cd => $genre_name)
									<option value="{{ $genre_cd }}">{{ $genre_name}}</option>
								@endforeach
							</select>
							{{-- 検索パラメーター判定する --}}
							<input type="hidden" name="condition" value="genre_cd">
							<div class="mt-2 mb-2">
								<button type="submit" class="btn btn-primary">検索</button>
							</div>
						</form>
					</div>
					<h6>市町村から探す</h6>
					<div>
						<form method="GET" action="{{ route('search', 'city_cd') }}"  target="_blank">
							<select name="city_cd" class="form-control">
								<option disabled selected>選択してください</option>
								@foreach (session('city_data') as $city_cd => $city_name)
									<option value="{{ $city_cd }}">{{ $city_name}}</option>
								@endforeach
							</select>
							<input type="hidden" name="condition" value="city_cd">
							<div class="mt-2 mb-2">
								<button type="submit" class="btn btn-primary">検索</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-9 border rounded border-dark">
				<h6 class="p-1 mb-1 text-dark">新着のお店</h6>
				<div class="table_parts">
					<table class="table table-borderless">
						@foreach ($shop_data as $item)
							<tbody>
							<tr>
								<td><a href="{{ route('detail',$item->shop_cd )}}">{{ $item->shop_name }}</a></td>
							</tr>
							<tr>
								<td>
									<div class="image_space">
									<img src="{{ asset('storage/shop_image/' . $item->shop_image) }}" width="30%" class="img-fluid img-circle">
									</div>
								</td>
							</tr>
							</tbody>
						@endforeach
					</table>
				</div>
				<div class="text-right">
				<a href="{{ route('search', ['condition' => 'top']) }}">>>登録されたお店はこちら</a>
				</div>
				<div>
					<h6 class="p-1 mb-1 text-dark">注目のお店</h6>
					<div class="table_parts">
					<table class="table table-borderless">
						<tbody>
						<tr>
							<td><a href=""></a></td>
						</tr>
						<tr>
							<td>
								<div class="image_space">
									<img src="">
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				@if (Auth::check())
					<h6 class="p-1 mb-1 text-dark">{{ Auth::user()->name }}さんのオススメ抹茶スイーツ</h6>
				@endif
				<h6 class="p-1 mb-1 text-dark">Twitter情報(commingsoon....)</h6>
			</div>
		</div>
	</div>
	</div>

@endsection
