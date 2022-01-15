<!-- Navigation -->
<nav class="navbar navbar-dark bg-primary static-top sticky-top">
	<a href="/shizuoka/index" class="navbar-brand">Top</a>
	@guest (Session::has('user_name'))
		<p>ようこそ、ゲストさん</p>
	@else
		<p class="h4 text-white">{{ Auth::user()->name }}さんがログイン中</p>
	@endguest
	<button
		class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navmenu1"
		aria-controls="navmenu1"
		aria-expanded="false"
		aria-label="Toggle navigation">
		メニュー<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navmenu1">
		<div class="navbar-nav">
			@guest
				<a class="nav-link" href="{{ route('register') }}">サインアップ</a>
				<a class="nav-link" href="{{ route('admin_login') }}">管理者ログイン</a>
			@else
				<form action="{{ route('logout') }}" method="post">
					@csrf
					<button class="btn btn-link nav-link" type="submit">ログアウト</button>
				</form>
			@endguest
			<span>検索メニュー</span>
			<div class="d-lg-flex justify-content-around">
				<form method="GET" action="{{ route('search') }}" class="form-inline" target="_blank">
					<input type="text" name="shop_name" class="form-control" placeholder="キーワード">
					<input type="hidden" name="condition" value="shop_name">
					<button type="submit" class="btn btn-info">検索</button>
				</form>
				<form method="GET" action="{{ route('search', 'genre_cd') }}" class="form-inline" target="_blank">
					<select name="genre_id" class="form-control">
						<option disabled selected>ジャンルから検索</option>
						@foreach (session('genre_data') as $genre_cd => $genre_name)
							<option value="{{ $genre_cd }}">{{ $genre_name }}</option>
						@endforeach
					</select>
					<input type="hidden" name="condition" value="genre_cd">
					<input type="button" class="btn btn-info" value="検索">
				</form>
				<form method="GET" action="shop_city_list.php" class="form-inline" arget="_blank">
					<select name="city_id" class="form-control" >
						<option disabled selected>市町村から検索</option>
						@foreach (session('city_data') as $city_cd => $city_name)
							<option value="{{ $city_cd }}">{{ $city_name }}</option>
						@endforeach
					</select>
					<input type="hidden" name="condition" value="city_cd">
					<input type="button" class="btn btn-info" value="検索">
				</form>
			</div>
		</div>
	</div>
</nav>
<!-- / Navigation -->
