var telopData = [], tID = [], timerID;
var telopURL = "http://yife.info/src/telop/35.json";	// テロップデータのURL
var telopY = startY = -270;	// テロップの表示Y座標
var telopRight = 400;	// テロップが登場する右端の座標
var telopOffset  = 30;	// テロップの表示位置のオフセット
var telopBottom = 150;	// テロップの下限の座標
// ページが読み込まれたらテロップデータの読み込みと設定を行う
window.addEventListener("load", function(){
	$.get(telopURL, function(text){	// テロップデータを読み込む
		document.getElementById("telopCommand").value = text;
		telopData = eval(text);
	});
	// テキストエリア内のデータが更新されたらテロップデータを反映し、再度最初から再生する
	document.getElementById("telopCommand").addEventListener("change", function(){
		telopData = eval(document.getElementById("telopCommand").value);
		playVideo();
	}, true);
}, true);
// テロップの移動を行い、新たなテロップを追加する
function moveTelop(){
	// 再生時間を表示
	//document.getElementById("playTime").innerHTML = document.getElementById("myVideo").currentTime+"秒";
	// テロップを移動させる処理
	for(var i=0; i<tID.length; i++){
		var x = parseInt(document.getElementById(tID[i]).style.left);
		if (x > -9999){
			document.getElementById(tID[i]).style.left = (x - 20) + "px";
		}
	}
	// テロップを新たに追加するかどうか調べる
	for(var i=0; i<telopData.length; i++){
		if (checkTelop(telopData[i].id) == true) continue;	// すでにテロップが表示されている場合はループの先頭へ
		if (document.getElementById("myVideo").currentTime >= telopData[i].sec){
			var ele = document.createElement("div");	// テロップを表示するdivを生成
			ele.innerHTML = telopData[i].text;	// 表示する文字を設定
			ele.className = "message";	// テロップのスタイルシートを設定
			ele.style.left = telopRight+"px";
			ele.style.top = telopY+"px";
			tID.push(ele.id = telopData[i].id);
			document.getElementById("telop").appendChild(ele);
			telopY = telopY + telopOffset;	// オフセットを加算
			if (telopY > telopBottom) telopY = startY;	// 画面下まできたら座標を上に戻す
		}
	}
}
// テロップが表示されているかどうか調べる。あればtrue、なければfalseを返す
function checkTelop(checkID){
	for(var j=0; j<tID.length; j++){
		if (tID[j] == checkID) return true;	// すでに表示している場合はtrueを返す
	}
	return false;
}
// 映像を再生する
function playVideo(){
	if (timerID) clearInterval(timerID);
	tID = [];
	var tDiv = document.getElementById("telop");
	var tList = tDiv.getElementsByTagName("div");	// テロップを全て削除
	for(var i=tList.length-1; i>=0; i--) tDiv.removeChild(tList[i]);
	telopY = startY;
	document.getElementById("myVideo").currentTime = 0;
	document.getElementById("myVideo").play();
	timerID = setInterval("moveTelop()", 100);	// 0.1秒ごとにテロップを動かす
	return false;
}

