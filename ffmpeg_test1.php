<?php
$video_path = '../tests/test_media/robot.avi';

$video = new ffmpeg_movie($video_path); //インスタンスを生成

echo $video->getFileName();
echo '<br>';
echo $video->getFrameRate();