@extends('layouts.master_bootstrap')
@section('title', 'お問い合わせ')
@section('content')
    <div class="container p-lg-5 bg-light">
        <h2 class="text-center mb-5">お問い合わせ</h2>
        <form method="POST" class="needs-validation">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="lastname">名字</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="名字" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="firstname">名前</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="名前" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Eメール</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Eメール" required>
                </div>
            </div>
            <div class="form-group">
                <label for="textarea">備考</label>
                <textarea class="form-control" name="textarea" id="textarea" rows="3" placeholder="何かあれば"></textarea>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">確認</button>
                </div>
            </div>
        </form>
    </div>
@endsection
