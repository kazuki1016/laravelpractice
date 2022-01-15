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
    @if (Auth::user()->name === 'admin')
        <button type="button"
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
                <li class="nav__item"><a class="nav-link" href="">ユーザー管理ページ</a></li>
                <li class="nav__item"><a class="nav-link" href="">口コミ管理ページ</a></li>
                <li class="nav__item"><a class="nav-link" href="">お店登録へ</a></li>
            </ul>
        </div>
    @else
        <button type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#bs-navi"
                aria-controls="bs-navi"
                aria-expanded="false"
                aria-label="Toggle navigation">
        マイページメニュー<span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="bs-navi">
            <ul class="navbar-nav">
                <li class="nav__item"><a class="nav-link" href="{{ route('mypage') }}">マイページtop</a></li>
                <li class="nav__item"><a class="nav-link" href="">お気に入りページ</a></li>
                <li class="nav__item"><a class="nav-link" href="{{ route('shop_regist') }}">お店登録へ</a></li>
            </ul>
        </div>
    @endif
</div>
