<!-- Navigation -->
<nav class="navbar navbar-dark bg-primary static-top sticky-top">
	<span class="navbar-brand">@yield('title')</span>
	<p class="h4 text-white">{{  Auth::guard('admin')->user()->name }}さんがログイン中</p>
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
				<a class="nav-link" href="{{ route('admin_login') }}">管理者ログイン</a>
			@else
				<a class="nav-link" href="{{ route('admin_register') }}">管理者登録</a>
				<a class="nav-link" href="{{ route('register') }}">一般ユーザー登録</a>
				<form action="{{ route('admin_logout') }}" method="post">
					@csrf
					<button class="btn btn-link nav-link" type="submit">ログアウト</button>
				</form>
				<a class="nav-link" href="{{ route('mypage') }}">お店管理ページ</a>
				<a class="nav-link" href="">登録ユーザー管理ページ</a>
				<a class="nav-link" href="">口コミ管理ページ</a>
			@endguest
		</div>
	</div>
</nav>
<!-- / Navigation -->
