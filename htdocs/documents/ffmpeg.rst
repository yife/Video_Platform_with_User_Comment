ffmpegのコマンド
=======================

2pass エンコーディングするなら
--------------------------------------------------

1pass try
ffmpeg -i __INPUT_FILE_NAME_ -vcodec libx264 -r 60 -b 600k -s 648x486 -deinterlace -pass 1 -an __OUTPUT_FILE_NAME

2pass try
ffmpeg -i __INPUT_FILE_NAME_ -vcodec libx264 -r 60 -b 600k -s 648x486 -deinterlace -pass 2 -acodec libfaac -ar 44100 -ab 128k __OUTPUT_FILE_NAME


1pass try
ffmpeg -i __INPUT_FILE_NAME_ -vcodec libx264 -r 60 -b 600k -s 864x486 -deinterlace -pass 1 -an __OUTPUT_FILE_NAME

2pass try
ffmpeg -i __INPUT_FILE_NAME_ -vcodec libx264 -r 60 -b 600k -s 864x486 -deinterlace -pass 2 -acodec libfaac -ar 44100 -ab 128k __OUTPUT_FILE_NAME


1回でやっちゃう系
----------------------------------------------------------

ffmpeg -i '__INPUT_FILE_NAME_' -vcodec libx264 -r 60 -b 600k -s 648x486 -deinterlace -acodec libfaac -ar 44100 -ab 128k __OUTPUT_FILE_NAME

たとえば
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

ffmpeg -i 'flv_on2vp6vp62_mp3.flv' -vpre libx264-default -vcodec libx264 -r 60 -b 600k -s 648x486 -deinterlace -acodec aac -strict experimental -ar 44100 -ab 128k 'flv_on2vp6vp62_mp3.mp4'

ffmpeg -i '【MMD】大人ネルにドラムをたたかせてみた - [sm16505281].mp4' -vpre libx264-default -vcodec libx264 -r 60 -b 600k -s 864x486 -deinterlace -acodec aac -strict experimental -ar 44100 -ab 128k 'neru_.mp4'