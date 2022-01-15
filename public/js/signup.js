//要素を取得
const password = document.getElementById('password');
const pass_check = document.getElementById('password-check')

pass_check.addEventListener("change", function(){
    if (pass_check.checked){
        password.setAttribute('type', 'text');  //input typeをpasswordからtextへ
    } else {
        password.setAttribute('type', 'password')  //input typeを戻す
    }
});

const password_confirm = document.getElementById('password-confirm');
const pass_conf_check = document.getElementById('password-check-conf')

pass_conf_check.addEventListener("change", function () {
    if (pass_conf_check.checked) {
        password_confirm.setAttribute('type', 'text');  //input typeをpasswordからtextへ
    } else {
        password_confirm.setAttribute('type', 'password')  //input typeを戻す
    }
});

/*
//バリデーション
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //querySelectorAllメソッドとは、指定したセレクタに一致するすべてのHTML要素(NodeList)を取得するメソッド。つまりバリデーションを行う要素をNodeList形式で取得をしている。
    var forms = document.querySelectorAll('.needs-validation')

    // 取得したNodeListを配列にする。配列にすることで各フォーム毎に処理が可能。
    Array.prototype.slice.call(forms).forEach(function (form) {
        //バリデーションが必要なフォームの入力部品をsubmitイベントのイベントリスナーとして登録し、各バリデーションを実施
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                //バリデーション実施時にsubmitイベントを中止する
                event.preventDefault()
                event.stopPropagation()
            }
            //バリデーション終了のCSSクラスを追加する
            form.classList.add('was-validated')
        }, false)
    })
})()
*/
