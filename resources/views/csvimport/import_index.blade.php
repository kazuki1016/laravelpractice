@extends('layouts.master_bootstrap')
@section('titile', 'csv取り込み')
@section('content')
    @if (Session::has('flashmessage'))
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script>
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });
        </script>
        <!-- モーダルウィンドウの中身 -->
        <div class="modal fade" id="myModal" tabindex="-1"
            role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        {{ session('flashmessage') }}
                    </div>
                    <div class="modal-footer text-center">
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container w-50 mt-3">
        <h2>Laravel で CSV インポート 演習</h2>
        <p>CSVファイルをテーブルに登録します。</p>
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <label for="file" class="col-1 col-form-label text-right ">File:</label>
                <div class="col-11">
                    <div class="custom-file">
                        <input type="file" name="csvfile" id="csvfile" class="custom-file-input-sm">
                        <label class="custom-file-label" for="csvfile" data-browse="参照" id="label">ファイル選択...</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 mb-3 d-flex justify-content-center">
                <button type="submit" class=" pl-3 pr-3 btn btn-success">csv登録</button>
            </div>
        </form>
    </div>
    <script>
        let file = document.getElementById('csvfile');
        let label = document.getElementById('label');
        console.log('test1');
        file.addEventListener("change", function(event){
            let filedata = event.target.files;
            let name = filedata[0].name;
            label.innerText = name;
        })

    </script>
@endsection
