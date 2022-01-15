@extends('layouts.master_shizuoka')
@section('title', '検索結果')
@section('content')
	<div class="container">
		@if (empty($search_name))
			<h5 class="my-3">登録されているお店一覧</h5>
		@else
			<h5 class="my-3">「{{ $search_name }}」の検索結果</h5>
		@endif
		<div class="card-deck mb-3">
			<div class="row w-100">
				@forelse ($shop_data as $item)
					<div class="col-md-4 mb-3">
						<div class="card mr-2">
								<img class="img-fluid img-circle" src="{{ asset('storage/shop_image/' . $item->shop_image) }}" style="object-fit: cover; width: 100%; height: 250px;">
							<div class="card-body">
								<h5 class="card-title" style="height: 150px">{{ $item->shop_name }}</h5>
								<a href="">{{ $item->city_name }}</a>/<a href="">{{ $item->genre_name }}</a>
							</div>
							<div class="card-footer bg-primary py-0 px-0">
								<a href="{{ route('detail',$item->shop_cd )}}" class="text-white py-2 text-center lead" style="display: block;">お店の詳細へ>></a>
							</div>
						</div>
					</div>
				@empty
					<p>まだ登録されていません</p>
				@endforelse
			</div>
		</div>
	</div>
@endsection

