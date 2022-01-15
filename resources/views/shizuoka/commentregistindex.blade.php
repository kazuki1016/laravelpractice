@extends('layouts.master_shizuoka')
@section('title', 'コメント登録画面')
@section('content')
	{{-- <style>
		.row{
			margin-right: 0;
			margin-left: 0;
		}
	</style> --}}
	<div class="container">
		@include('layouts.mypage_header')
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card mt-3 mb-3">
					<div class="card-header text-center lead">お店の口コミを登録してください</div>
					<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data" novalidate>

							{{--  コメント題名 --}}
							<div class="form-group row">
								<label for="comment_title" class="col-md-3 col-form-label text-md-center">コメント題名</label>
								<div class="col-md-9">
									<input id="comment_title" type="text" class="form-control @invalid('comment_title')" name="comment_title" value="{{ old('comment_title') }}" required autocomplete="comment_title" autofocus>
									<small><span class="text-danger"> *必須項目です</span>（20文字以内）</small>
									{{-- エラー出力を共通化 --}}
									@component('components.invalid_feedback', ['form_name' => 'comment_title'])
									@endcomponent
								</div>
							</div>

							{{-- 写真 --}}
							<div class="form-group row">
								<label for="comment_image" class="col-md-3 col-form-label text-md-center">好きな写真</label>
								<div class="col-md-9">
                                    {{-- 複数の写真をアップロードする場合はname属性を配列にする。accept属性で画像指定 --}}
									<input type="file" multiple files id="comment_image" class="col-form-label form-control-file @invalid('comment_image')" name="comment_image[]" accept="image/*">
									@error('comment_image')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="comment_body" class="col-md-3 col-form-label text-md-center">コメント本文</label>
								<div class="col-md-9">
									<textarea class="form-control @invalid('comment_body')" name="comment_body" id="comment_body" cols="30" rows="10" required>{{ old('comment_body') }}</textarea>
									<small><span class="text-danger"> *必須項目です</span>（500字以内）</small>
									@error('comment_body')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							{{-- 登録ボタン --}}
							<div class="form-group row mb-0">
								<div class="col-6 offset-4">
									<button type="submit" class="btn btn-primary pl-5 pr-5">登録</button>
								</div>
							</div>

							@csrf
							<input type="hidden" name="shop_cd" value="{{
							$shop_cd }}">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
