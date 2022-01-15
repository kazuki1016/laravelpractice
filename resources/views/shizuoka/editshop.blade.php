@extends('layouts.master_shizuoka')
@section('title', '編集画面')
@section('content')
	<div class="container">
		@include('layouts.mypage_header')
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card mt-3 mb-3">
					<div class="card-header text-center lead">お店編集画面</div>
					<div class="card-body">
						<form method="POST" action="" enctype="multipart/form-data" novalidate>

							{{--  お店の名前 --}}
							<div class="form-group row">
								<label for="shop_name" class="col-md-3 col-form-label text-md-center">お店の名前</label>
								<div class="col-md-9">
									<input id="shop_name" type="text" class="form-control @invalid('shop_name')" name="shop_name" value="{{ old('shop_name', $shop_data->shop_name) }}" required autocomplete="shop_name" autofocus>
									<small><span class="text-danger"> *必須項目です</span>（50文字以内）</small>
									{{-- エラー出力を共通化 --}}
									@component('components.invalid_feedback', ['form_name' => 'shop_name'])
									@endcomponent
								</div>
							</div>

							{{--  ジャンル指定 --}}
							<fieldset class="form-group mb-0">
								<div class="row">
									<legend class="col-form-label col-md-3 text-md-center no-gutters">ジャンル</legend>
									<div class="col-md-9 align-middle">
										<div>
											@foreach (session('genre_data') as $genre_cd  => $genre_name)
												<input id="{{ $genre_name }}" type="radio" name="genre_cd" value="{{ $genre_cd }}" {{ old('genre_cd', $shop_data->genre_cd) == $genre_cd ? "checked" : '' }}>
												<label for="{{ $genre_name}}" class="form-check-label">{{ $genre_name }}</label>
											@endforeach
										</div>
									</div>
								</div>
							</fieldset>

							{{-- 市町村リスト --}}
							<div class="form-group row mt-3">
								<label for="city_cd" class="col-md-3 col-form-label text-md-center">市町村</label>
								<div class="col-md-3">
									<select name="city_cd" id="city_cd" class="form-control">
										@foreach (session('city_data') as $city_cd => $city_name)
											<option value="{{ $city_cd }}" {{ old('city_cd', $shop_data->city_cd ) == $city_cd ? "selected" : "" }}>{{ $city_name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							{{-- お店住所 --}}
							<div class="form-group row">
								<label for="address" class="col-md-3 col-form-label text-md-center">お店の住所</label>
								<div class="col-md-9">
									<input type="text" name="address" id="address" class="form-control @invalid('address')" placeholder="〇〇市からでOK!" >
									<small><span class="text-danger"></span>（255字以内）</small>
									@component('components.invalid_feedback', ['form_name' => 'address'])
									@endcomponent
								</div>
							</div>

							{{-- お店の写真 --}}
							<div class="form-group row">
								<label for="shop_image" class="col-md-3 col-form-label text-md-center">お店の写真</label>
								<div class="col-md-9">
									<input id="shop_image" class="col-form-label form-control-file @invalid('shop_image')" type="file" name="shop_image">
									@component('components.invalid_feedback', ['form_name' => 'shop_image'])
									@endcomponent
								</div>
							</div>

							<div class="form-group row">
								<label for="shop_detail" class="col-md-3 col-form-label text-md-center">お店紹介文</label>
								<div class="col-md-9">
									<textarea class="form-control @invalid('shop_detail')" name="shop_detail" id="shop_detail" cols="30" rows="10" required>{{ $shop_data->shop_detail }}</textarea>
									<small><span class="text-danger"> *必須項目です</span>（300字以内）</small>
									@component('components.invalid_feedback', ['form_name' => 'shop_detail'])
									@endcomponent
								</div>
							</div>

							{{-- 登録ボタン --}}
							<div class="form-group row mb-0">
								<div class="col-6 offset-4">
									<button type="submit" class="btn btn-primary pl-5 pr-5">登録</button>
								</div>
							</div>
							@csrf
							<input type="hidden" name="shop_cd" value="{{ $shop_data->shop_cd }}">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
