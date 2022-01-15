@extends('layouts.master_bootstrap')
@section('title', 'お問い合わせ確認')
@section('content')
    <div class="container p-lg-5 bg-light">
        <h2 class="text-center mb-5">お問い合わせ内容確認</h2>
        <form method="POST">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label>名字</label>
                </div>
                <div class="col-md-3 mb-3">
                    {{ $lastname }}
                </div>
                    <input type="hidden" name="lastname" value="{{ $lastname }}">
                <div class="col-md-3 mb-3">
                    <label>名字</label>
                </div>
                <div class="col-md-3 mb-3">
                    {{ $firstname }}
                </div>
                    <input type="hidden" name="firstname" value="{{ $firstname }}" >
            </div>
            <div class="form-group row">
                <label class="col-sm-2">Eメール</label>
                <div class="col-sm-10">
                    {{ $email }}
                    <input type="hidden" name="email" value="{{ $email }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2">備考</label>
                <div class="col-sm-10">
                    {{ $textarea }}
                </div>
                <input type="hidden" name="textarea" value="{{ $textarea }}">
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">登録</button>
                </div>
            </div>
        </form>
    </div>
@endsection
