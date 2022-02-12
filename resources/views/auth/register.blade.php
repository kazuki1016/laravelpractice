@extends('layouts.master_shizuoka')
@section('title', '新規登録画面')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card mt-3 mb-3">
					<div class="card-header text-center lead">会員登録フォーム</div>
					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名：</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
									<small><span class="text-danger"> *必須項目です</span></small>
									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス：</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
									<small><span class="text-danger"> *必須項目です</span></small>
									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">パスワード：</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
									<div><small>（半角英数字8字以上）</small></div>
									<input type="checkbox" id="password-check">
									<label for="password-check"><small>パスワードを表示する</small></label>
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード（確認用）: </label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
									<div><small><span class="text-danger"> *必須項目です</span>（半角英数字8字以上）</small></div>
									<input type="checkbox" id="password-check-conf">
									<label for="password-check-conf"><small>パスワードを表示する</small></label>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary pl-5 pr-5">確認</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
		{{-- ユーザー登録用バリデーション --}}
	<script src="{{ asset('js/signup.js') }}"></script>

@endsection
