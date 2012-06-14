// コメントを投稿する
function PostComment(){
	var comment_text = $("#comment_text").val();
	
	if( comment_text != '' && document.getElementById("myVideo").currentTime != 0 ){
	   //再生時間が0でなく、テキストボックスになにか入力されていたら
	   
	   //各種の必要な値を取ってくる
    	var nowtime = document.getElementById("myVideo").currentTime;
    	var user_id = $("p#userID").text();
    	var video_number = $("p#video_number").text();
    	
    	//nowtimeの値（浮動小数点の秒数）を修正
    	nowtime = Math.round(nowtime * 10 );
    	
    	//コメントフォームをクリア
    	$('#comment_text').val('');
    	
    	console.log(nowtime);
    	console.log(comment_text);
    	console.log(user_id);
    	
    	//GETリクエストを組み立てる
    	var baseurl = 'http://yife.info/src/json_appender.php?';
    	var video_number = 'v_num=' + video_number + '&';
    	var user_id = 'id=' + user_id + '&';
    	var nowtime = 'vpos=' + nowtime + '&';
    	var comment_text = 'text=' + comment_text;
    	var request_url = baseurl + video_number + user_id + nowtime + comment_text;
    	
    	console.log(request_url);
    	$.get(request_url);
    	
	}
}