<?php
$video_path = '../tests/test_media/robot.avi';

$video = new ffmpeg_movie($video_path); //インスタンスを生成

/*
echo $video->getFileName();
echo '<br>';
echo $video->getFrameRate();
echo '<br>';
echo $video->getDuration();
echo '<br>';
echo $video->getFrameCount();
echo '<br>';
echo $video->getTitle();
echo '<br>';
echo $video->getAudioBitRate();
echo '<br>';
echo $video->getAudioCodec();
echo '<br>';
echo $video->getVideoCodec();
echo '<br>';
echo $video->hasAudio();
*/

//サムネイルを取得
$frame = $video->getFrame(100);
$image = $frame->toGDImage();

header('Content-Type: image/jpeg');
imageJpeg($image,null,100);
imageDestroy($image);