//全削除のtd要素を取得
const checkFieldAll 	= document.getElementById('deleteAll');

//全削除チェックボックスの要素を取得
const deleteCheckBoxAll = document.getElementById('deleteCheckBoxAll');

//各td要素を取得
const checkField 		= document.getElementsByClassName('delete');

//各チェックボックスの要素を取得
const deleteCheckBox 	= document.getElementsByClassName('deleteCheckBox');

//チェックボックスの数を定義
const target 			= deleteCheckBox.length;

//チェックボックスONOFFされた場合のイベントを記述
deleteCheckBoxAll.addEventListener('change', function(){
	checkAll(deleteCheckBoxAll, deleteCheckBox, target);
	changeColor();
})

//td要素がクリックされた場合のイベントを記述
checkFieldAll.addEventListener('click', function () {
	checkAll(deleteCheckBoxAll, deleteCheckBox, target);
	changeColor();
});

//チェックボックスがONの場合は色が灰色になるメソッド
function changeColor(){
	for (let index = 0; index < target; index++) {
		var checkBox = document.getElementById('checkBox'+[index]);
		var dataRow = document.getElementById('dataRow'+[index]);
		if (checkBox.checked){
			dataRow.style.backgroundColor = '#BBBBBB';
		} else {
			dataRow.style.backgroundColor = '#FFFFFF';
		}
	}
}

//全削除された場合に各行のチェックボックスが連動してONOFFを切り替える関数
function checkAll(CheckBoxAll, CheckBox, targetNum){
	let targetCount = 0;
	//td領域がクリックされたらチェックのONOFFを実施
	if (!(CheckBoxAll.checked)) {
		CheckBoxAll.checked = true;
		//全削除チェックの動作に合わせて各行のチェックを連動させる
		while (targetCount < targetNum) {
			CheckBox[targetCount].checked = true;
			targetCount++;
		}
	} else {
		CheckBoxAll.checked = false;
		while (targetCount < targetNum) {
			CheckBox[targetCount].checked = false;
			targetCount++;
		}
	}
}

//チェックされた際の処理
function checkBoxToggle(rowNumber){
	const targetCheckBox = document.getElementById('checkBox' + rowNumber);
	const targetDataRow = document.getElementById('dataRow' + rowNumber);
	if (!(targetCheckBox.checked)){
		targetCheckBox.checked = true;
		targetDataRow.style.backgroundColor = '#BBBBBB';
	} else {
		targetCheckBox.checked = false;
		targetDataRow.style.backgroundColor = '#FFFFFF';
	}
}

function delete_alert() {
	if (!window.confirm('お店を削除します。よろしいでしょうか？')) {
		return false;
	}
}
