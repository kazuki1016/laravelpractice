<style>
    .mypage_nav ul{
        margin: 0 auto;
        width: 100%;
    }
    .mypage_nav{
        max-width: 800px;
        margin: 0 auto;
    }
    .nav__item{
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="navbar mypage_nav navbar-expand navbar-light bg-light">
	<button
		type="button"
		class="navbar-toggler"
		data-toggle="collapse"
		data-target="#bs-navi"
		aria-controls="bs-navi"
		aria-expanded="false"
		aria-label="Toggle navigation">
		管理ページメニュー<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="bs-navi">
		<ul class="navbar-nav center-block">
			<li class="nav__item"><a class="nav-link" href="{{ route('mypage') }}">お店管理ページ</a></li>
			<li class="nav__item"><a class="nav-link" href="">登録ユーザー管理ページ</a></li>
			<li class="nav__item"><a class="nav-link" href="">口コミ管理ページ</a></li>
		</ul>
	</div>
</div>
