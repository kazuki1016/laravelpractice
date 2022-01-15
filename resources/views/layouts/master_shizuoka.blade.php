<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
    {{-- カスタムbootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	{{-- jQueryー --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	{{-- lightbox2。今回はカスタマイズなしなのでCDN経由で使用 --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
	<style>
		.SiteWrapper{
			display: flex;
			flex-direction:column;
			min-height: 100%;
		}
		.main{
			flex: 1;
			overflow-x: hidden;
		}
	</style>
</head>
<body>
	<div class="SiteWrapper">
		{{-- ヘッダー部。管理者と一般ユーザーとで分ける --}}
		@if (Auth::guard('admin')->check())
			@include('admin.admin_header')
		@else
			@include('layouts.shizuoka_header')
		@endif
		{{-- フラッシュメッセージ --}}
		@if (Session::has('message'))
			<script>
				//ページ読み込み後、モーダルを実行
				$(window).on('load', function (){
					$('#modal_box').modal('show');
				});
			</script>
			<!-- モーダルウィンドウの中身 -->
			<div class="modal fade" id="modal_box" tabindex="-1"
				role="dialog" aria-labelledby="label1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						{{-- <div class="modal-body">
							{{ session('message') }}
						</div> --}}
						<div class="modal-header">
							{{ session('message') }}
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
						</div>
					</div>
				</div>
			</div>
		@endif
		{{-- 例外発生時エラーメッセージ出力 --}}
		@if (Session::has('errormessage'))
			<div class="alert alert-danger text-center" role="alert">
				<strong>{{ session('errormessage') }}</strong>
			</div>
		@endif
		{{-- コンテンツ --}}
		<div class="main">@yield('content')</div>
		{{--フッダーー --}}
		@include('layouts.shizuoka_footer')
	</div>
</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>
