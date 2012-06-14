// コメントを投稿する
function PostTag(){
	var tag_text = $("#tag_text").val();
	
	if( tag_text != '' ){
	   //テキストボックスになにか入力されていたら
	   
	   //各種の必要な値を取ってくる
    	var video_number = $("p#video_number").text();
    	console.log(video_number);
    	console.log(tag_text);
    	
    	//コメントフォームをクリア
    	$('#tag_text').val('');
    	
    	//GETリクエストを組み立てる
    	var baseurl = 'http://yife.info/src/tag_appender.php?';
    	var video_number = 'v_num=' + video_number + '&';
    	var tag_text = 'tag=' + tag_text;
    	var request_url = baseurl + video_number + tag_text;
    	
    	console.log(request_url);
    	$.get(request_url);
    	
	}
}