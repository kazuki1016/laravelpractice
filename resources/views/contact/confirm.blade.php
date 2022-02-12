@extends('layouts.master_shizuoka')
@section('title', 'お問い合わせ')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card mt-3 mb-3">
					<div class="card-header text-center lead">お問い合わせ内容確認</div>
					<div class="card-body">
						<form method="POST">

							{{-- 問い合わせの人 --}}
							@csrf
							<div class="form-group row">
								<label for="inquirer" class="col-md-3 col-form-label text-md-right">お名前：</label>
								<div class="col-md-8">
									<input id="inquirer" type="text" class="form-control" name="inquirer" value="{{ $inquirer }}" readonly>
								</div>
							</div>

							{{-- お問合せ者のメールアドレス --}}
							<div class="form-group row">
								<label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス：</label>
								<div class="col-md-8">
									<input id="email" type="email" class="form-control" name="email" value="{{ $email }}" readonly>
								</div>
							</div>

							{{-- お問合せ内容 --}}
							<div class="form-group row">
								<label for="contact_detail" class="col-md-3 col-form-label text-md-right">お問合せ内容：</label>
								<div class="col-md-8">
									<textarea class="form-control" name="contact_detail" id="contact_detail" cols="100" rows="10" readonly>{{ $contact_detail }}</textarea>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" name="submit" value="submit" class="btn btn-primary pl-5 pr-5 mx-3">送信</button>
                                    <button type="submit" name="submit" value="back" class="btn btn-secondary pl-5 pr-5 mx-3">修正</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
