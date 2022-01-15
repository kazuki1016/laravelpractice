@extends('layouts.master_shizuoka')
@section('title', 'お店管理画面')
@section('content')
	<div class="container my-3"">
		<span>検索条件</span>
		<div class="my-2 row">
			<div class="col-md-5">
				店名
			</div>
			<div class="col-md-2">
				ジャンル名
			</div>
			<div class="col-md-2">
				市町村
			</div>
		</div>
		<div class="my-2 row">
			<form method="GET" action="{{ route('admin_home') }}" class="form-inline col-md-10">
				<input type="text" name="shop_name" class="mx-2" placeholder="キーワード" style="width: 45%;" value="{{ session('reqParam')['shop_name'] }}">
				<select name="genre_cd" class="mx-2" style="padding: 3px; width: 15%;">
					<option selected value="A" {{ session('reqParam')['genre_cd'] === "A" ? "selected" : "" }}>全て</option>
					@foreach (session('genre_data') as $genre_cd => $genre_name)
						<option value="{{ $genre_cd }}" {{ session('reqParam')['genre_cd'] == $genre_cd ? "selected" : "" }}>{{ $genre_name }}</option>
					@endforeach
				</select>
				<select name="city_cd" class="mx-2" style="padding: 2px; width: 15%;">
					<option selected value="A" {{ session('reqParam')['city_cd'] === "A" ? "selected" : "" }}>全て</option>
					@foreach (session('city_data') as $city_cd => $city_name)
						<option value="{{ $city_cd }}" {{ session('reqParam')['city_cd'] == $city_cd ? "selected" : "" }}>{{ $city_name }}</option>
					@endforeach
				</select>
				<div class="mx-auto">
					<button type="submit" class="btn-info px-3 ml-2">検索</button>
				</div>
			</form>
			<div class="my-auto">
				<a href="{{ route('admin_home') }}" class="col-md-2 text-primary" >検索初期化</a>
			</div>
		</div>

		<div class="justify-content-center">
			@if (count($shop_data) >0)
			<span class="text-right">
				全{{ $shop_data->total() }}件中
				{{  ($shop_data->currentPage() -1) * $shop_data->perPage() + 1}} -
				{{ (($shop_data->currentPage() -1) * $shop_data->perPage() + 1) + (count($shop_data) -1)  }}件表示
			</span>
			@else
			<span>{{ $shop_data->total() }}件</span>
			@endif
		</div>

		<div class="table-responsive my-2" style="height: 300px; orverflow-y: scroll; border: solid 3px grey ;">
			<table class="table table-sm bg-white" style="overflow-y: scroll;" border="1" style="border-collapse: collapse">
				<thead class="bg-primary text-white text-nowrap text-center" style="position: sticky; top: 0; z-index: 1;">
					<td id="deleteAll">
						<div class="text-center">
							<label class="col-form-label">全削除</label>
							<div>
								<input type="checkbox" id="deleteCheckBoxAll" style="transform:scale(1.5);">
							</div>
						</div>
					</td>
					<td class="align-middle">お店<br>コード</td>
					<td class="align-middle w-25">お店名称</td>
					<td class="align-middle">登録<br>市町村</td>
					<td class="align-middle">登録<br>ジャンル</td>
					<td class="align-middle">登録者<br>コード</td>
					<td class="align-middle">登録者名</td>
					<td class="align-middle">登録日時</td>
					<td class="align-middle">更新日時</td>
				</thead>
				<form action="{{ route('admin_delete') }}" method="post" style="display: inline;">
					@csrf
					@forelse ($shop_data as $index => $item)
					<tbody class="dataRow" id="dataRow{{ $index }}">
						<td class="text-center align-content-around align-middle delete"  onclick="checkBoxToggle({{ $index }})">
							<input type="checkbox" id="checkBox{{ $index }}" name="delete[]" class="deleteCheckBox" style="transform:scale(1.5);" value="{{ $item->shop_cd }}" onclick="checkBoxToggle({{ $index }})">
						</td>
						<td class="text-right align-middle">{{ $item->shop_cd }}</td>
						<td class="align-middle">{{ $item->shop_name }}</td>
						<td class="align-middle">{{ $item->city_name }}</td>
						<td class="align-middle">{{ $item->genre_name }}</td>
						<td class="text-right align-middle">{{ $item->user_cd }}</td>
						<td class="align-middle">{{ $item->user_name }}</td>
						<td class="align-middle">{{ $item->created_at }}</td>
						<td class="align-middle">{{ $item->updated_at }}</td>
					</tbody>
					@empty
						お店は登録されていません
					@endforelse
				</table>
			</div>
			{{ $shop_data->links('vendor.pagination.custom-pagenation') }}
			<button type="submit" class="btn-secondary" onClick="return delete_alert();">削除実行</button>
		</form>

	</div>
	<script src="{{ asset('js/checkbox.js') }}">
	</script>
@endsection
