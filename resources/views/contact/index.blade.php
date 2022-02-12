@extends('layouts.master_shizuoka')
@section('title', 'お問い合わせ')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card mt-3 mb-3">
					<div class="card-header text-center lead">お問い合わせフォーム</div>
					<div class="card-body">
						<form method="POST">
							{{ method_field('patch') }}

							{{-- 問い合わせの人 --}}
							@csrf
							<div class="form-group row">
								<label for="inquirer" class="col-md-3 col-form-label text-md-right">お名前：</label>
								<div class="col-md-8">
									<input id="inquirer" type="text" class="form-control @invalid('inquirer')" name="inquirer" value="{{ $inquirer ?? '' ? $inquirer ?? '' : old('inquirer') }}" required autofocus>
									<small><span class="text-danger"> *必須項目です</span></small>
									{{-- エラー出力を共通化 --}}
									@component('components.invalid_feedback', ['form_name' => 'inquirer'])@endcomponent
								</div>
							</div>

							{{-- お問合せ者のメールアドレス --}}
							<div class="form-group row">
								<label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス：</label>
								<div class="col-md-8">
									<input id="email" type="email" class="form-control @invalid('email')" name="email" value="{{ $email ?? '' ? $email ?? '' : old('email') }}" required autocomplete="email">
									<small><span class="text-danger"> *必須項目です</span></small>
									@component('components.invalid_feedback', ['form_name' => 'email'])@endcomponent
								</div>
							</div>

							{{-- お問合せ内容 --}}
							<div class="form-group row">
								<label for="contact_detail" class="col-md-3 col-form-label text-md-right">お問合せ内容：</label>
								<div class="col-md-8">
									<textarea class="form-control @invalid('contact_detail')" name="contact_detail" id="contact_detail" cols="100" rows="10" required>{{ $contact_detail ?? '' ? $contact_detail ?? '' : old('contact_detail') }}</textarea>
									<small><span class="text-danger"> *必須項目です（1000文字以内）</span></small>
									@component('components.invalid_feedback', ['form_name' => 'contact_detail'])@endcomponent
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
@endsection
