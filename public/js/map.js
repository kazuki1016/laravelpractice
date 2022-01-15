// googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
function initMap() {
	const target = document.getElementById('map');		//マップを表示する要素を指定
	const data = document.getElementById('location');	//住所を指定する要素の指定
	let address = data.innerText;						//住所を指定
	var geocoder = new google.maps.Geocoder();			//geocoderインスタンスの生成

	geocoder.geocode({ address: address }, function (results, status) {
		if (status === 'OK' && results[0]) {


			//お店の地図をgoogle mapで描画。targetで地図を表示したい要素を指定。Map関数はコンストラクター
			var map = new google.maps.Map(target, {
				center: results[0].geometry.location,
				zoom: 18
			});

			//ピンを立てる。
			var marker = new google.maps.Marker({
				position: results[0].geometry.location,
				map: map,
				// animation: google.maps.Animation.DROP	//アニメーション。一先ず無効にする。
			});

			//お店の郵便番号を取得してハイフンを削除
			let mapObject = results[0].address_components;
			// console.log(mapObject);

			//APIから取得したデータから郵便番号持つオブジェクトを抽出
			let postData = mapObject.filter(function(item){
				if(item.types[0] === 'postal_code') return true;
			});
			// console.log(postData[0].long_name);

			let addressPostNumber = postData[0].long_name;

			//郵便番号をハイフンなしの7桁で取得
			let postNumber = addressPostNumber.replace("-", "");

			//javaScript内でhttpリクエスト
			let request = new XMLHttpRequest();

			//リクエストを定義
			request.open("GET", `https:geoapi.heartrails.com/api/json?method=getStations&postal=${postNumber}`);

			//レスポンスタイプを設定
			request.responseType = 'json';

			//リクエストを送信
			request.send();

			//レスポンスを受け取る
			request.onload = function(){
				let responseObject = request.response;

				let stations = responseObject.response.station;
				console.log(stations);
				//tdタグを生成

				for(let i=0; i<stations.length; i++) {
					const table = document.getElementById('table');
					//駅の数だけtrタグを追加してtableの子要素にする
					const tr = document.createElement("tr");
					table.appendChild(tr);

					//id名を追加して判別
					tr.setAttribute('id', `station${[i]}`);

					//オブジェクト→配列へ変換
					let station = Object.keys(stations[i]).map(function (key) { return stations[i][key] });
					console.log(station);

					let data = [station[0], station[2], Math.round(station[9])+'m'];
					console.log(data);

					for (let j=0; j<data.length; j++) {
						const tr = document.getElementById(`station${[i]}`);
						//要素の数だけtdタグを追加してtrの子要素にする。
						const td = document.createElement('td');
						tr.appendChild(td);
						td.innerText = data[j];
					}
				}
			};
		} else {
			//住所が存在しない場合の処理
			alert('住所が正しくないか存在しません。');
			target.style.display = 'none';
			table.style.display = 'none';
		}
	});
	/*
		map = document.getElementById("map");
		// 東京タワーの緯度は35.6585769,経度は139.7454506と事前に調べておいた
		let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
		// オプションを設定
		opt = {
			zoom: 13, //地図の縮尺を指定
			center: tokyoTower, //センターを東京タワーに指定
		};
		// 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
		mapObj = new google.maps.Map(map, opt);

		// 追加
		marker = new google.maps.Marker({
			// ピンを差す位置を決めます。
			position: tokyoTower,
		// ピンを差すマップを決めます。
			map: mapObj,
		// ホバーしたときに「tokyotower」と表示されるようにします。
			title: 'tokyotower',
		});
	*/
}
