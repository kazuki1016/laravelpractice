@extends('layouts.master_shizuoka')
@section('title', 'マイページ')
@section('content')
	<div class="container mt-3 mb-3">
		@if (Auth::user()->name === 'admin')
			<h5>お店管理ページ</h5>
		@else
			<h5>{{ Auth::user()->name }}さんのマイページ</h5>
		@endif
		@include('layouts.mypage_header')
		<h5>投稿したお店</h5>
		<div class="card-deck mb-3">
			<div class="row w-100">
				@forelse ($shop_data as $item)
					<div class="col-md-4 mb-3">
						<div class="card mr-2">
								<img class="img-fluid img-circle" src="{{ asset('storage/shop_image/' . $item->shop_image) }}" style="object-fit: cover; width: 100%; height: 250px;">
							<div class="card-body">
								<h5 class="card-title" style="height: 150px">{{ $item->shop_name }}</h5>
								<a href="">{{ $item->city_name }}</a>/<a href="">{{ $item->genre_name }}</a>
								<a href="{{ route('edit', $item->shop_cd) }}"><button class="btn btn-info">編集</button></a>
								<form action="{{ route('delete', $item->shop_cd) }}" method="post" style="display: inline;">
									<button type="submit" class="btn btn-secondary inline" onClick="return delete_alart(event);">削除</button>
									@csrf
								</form>
							</div>
							<div class="card-footer bg-primary py-0 px-0">
								<a href="{{ route('detail',$item->shop_cd )}}" class="text-white py-2 text-center lead" style="display: block;">お店の詳細へ>></a>
							</div>
						</div>
					</div>
				@empty
					<p>登録したお店はまだありません</p>
				@endforelse
			</div>
		</div>
	</div>
	<script>
		function delete_alart(event){
			if(!window.confirm('お店を削除します。よろしいでしょうか？')){
				return false;
			}
		}
	</script>
@endsection
