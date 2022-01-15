@extends('layouts.master_shizuoka')
@section('title', "$shop_detail->shop_name|お店詳細")
@section('content')
	{{-- Lightboxのoption --}}
	<div class="text-center my-5">
		<img class="img-fluid" src="{{ asset('storage/shop_image/' . $shop_detail->shop_image) }}" width="400" height="400" alt="{{ $shop_detail->shop_name }}">
	</div>

	{{-- お店紹介 --}}
	<div class="container">
		<h3 class="text-left d-inline-block">{{ $shop_detail->shop_name }}</h3>
		<div class="mx-auto" style="border-bottom: solid 1px #2BA69D ;" ></div>
		<table>
			<tr>
				<th width="10%" class="text-right">所在地：</th>
				<td>{{ $shop_detail->city_name }}</td>
			</tr>
			<tr>
				<th class="text-right">ジャンル：</th>
				<td>{{ $shop_detail->genre_name }}</td>
			</tr>
			<tr>
				<th class="text-right align-baseline">お店紹介文：</th>
				<td>{{ $shop_detail->shop_detail }}</td>
			</tr>
			<tr>
				<th class="text-right align-baseline">お店住所：</th>
				<td id="location">{{ $shop_detail->address }}</td>
			</tr>
		</table>

		{{-- 地図を表示 --}}
		<div id="map" style="height:500px;"></div>

		{{-- 最寄りの駅を表示 --}}

		<table id="table" class="table table-striped mt-5">
			<thead>
				<th>最寄駅名</th>
				<th>線名</th>
				<th>駅からの距離</th>
			</thead>
			{{-- <tr id="stationRow">
				<td>1111</td>
				<td>2222</td>
				<td>33333</td>
			</tr> --}}
		</table>
		{{-- 口コミ登録画面へ遷移 --}}
		<div class="form-group row my-3">
			<div class="col-6 offset-5">
				<a href="{{ route('comment', $shop_detail->shop_cd) }}"><button type="submit" class="btn btn-primary px-3">口コミを書く</button></a>
			</div>
		</div>
	</div>

	{{-- 口コミ --}}
	<h3 class="my-5 text-center border-bottom">このお店の口コミ</h3>
	<div class="container">
		@forelse ($comment_data as $comment_cd => $data)
			<div class="card my-5">
				<div class="card-header bg-primary text-white">{{ $data['user_name'] }}</div>
				<div class="card-body">
					@if (isset($data['comment_date']))
						{{-- クエリビルダーでデータを取得しているので文字列として取得される。文字列をdate型に変換してからdate関数でフォーマット変更 --}}
						<p>コメント日：{{ date('Y年m月d日', strtotime($data['comment_date']))}}</p>
					@endif
					<h3 class="card-title"><strong style="border-bottom: solid 2px black;">{{ $data['comment_title'] }}</strong></h3>
					{{-- 改行コードを有効にするにはnl2br関数を使用するが、{{}}で展開すると改行コードがエスケープされるのでヘルパー関数のe()を使って<br>以外をエスケープする--}}
					<h4 class="card-text">{!! nl2br(e($data['comment_body'])) !!}</h4>
				</div>
				<div class="card-footer text-muted">
					@if (array_key_exists('commentimage', $data))
						@foreach ( $data['commentimage'] as $image )
							<a href="{{ asset('/storage/comment_image/' . $image) }}" data-lightbox="group{{ $comment_cd }}">
								<img class="img-fluid my-2 mx-2" src="{{ asset('/storage/comment_image/' . $image) }}" alt="" width="150">
							</a>
						@endforeach
					@else
						<p>写真なし</p>
					@endif
				</div>
			</div>
		@empty
			<p>まだコメントはありません。</p>
		@endforelse
	</div>
	<script src="{{ asset('js/map.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAJaLzowYasoJWuOFJQRFYdMNHnD7cqVVs&callback=initMap" async defer></script>
@endsection
