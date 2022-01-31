<?php

declare(strict_types=1);

/**
 * Video Splitter
 *
 * @see https://github.com/nsmle/video-splitter for more informations.
 *
 * @author   nsmle <fikiproductionofficial@gmail.com>
 *
 * Code using Library FFmpeg
 * @see https://ffmpeg.org
 */


// Video directory and name, e.g. "video.mp4" or "videos/Video.mp4" and etc.
$video = "XXXXXX";

// Directory for separate videos, Result of split video. e.g. "tutorial" or "tutorials/php" etc.
$folder = "XXXXXX";

// Timeline for splitting videos
// With Format "<time> - <title>"
/* e.g.
00:00:00 - Video split 1
00:02:56 - Video split 2
00:14:56 - Video split 3
00:24:56 - Video split 4
*/
$timeline = <<<TIMELINE
XXXXXX
TIMELINE;




/*
|--------------------------------------------------------------------------
| FFmpeg Log Level
|--------------------------------------------------------------------------
|
| Supported: "-loglevel quiet", "-loglevel panic", "-loglevel fatal", "-loglevel error", "-loglevel warning", "-loglevel info", "-loglevel verbose", "-loglevel debug", "-loglevel trace"
|
*/
$logLevel = "-loglevel error";



if ($video == 'XXXXXX' || $folder == 'XXXXXX' || $timeline == 'XXXXXX') {
    die('Replace XXXXXX in $video, $folder, and $timeline, with your configuration!'."\n");
}

$videoTheme = [];
if (file_exists($video)) {
    $lines = explode("\n", $timeline);
    foreach ($lines as $line) {
        $videoThemeMetaData = explode(' - ', $line);
        $videoThemeMetaData = [
            'time' => $videoThemeMetaData[0],
            'title' => $videoThemeMetaData[1]
        ];
        
        $videoTheme = array_merge($videoTheme, [$videoThemeMetaData]);
    }
} else {
    die("\033[0;31mVideo \033[5;31m\033[3;31m$video\033[0;31m not found!\033[0m\n");
}



for ($i = 1; $i < count($videoTheme); $i++) {
    $videoTimeStart = $videoTheme[$i]['time'];
    $videoTimeEnd = $videoTheme[$i + 1]['time'];
    $videoTitle = "$i. {$videoTheme[$i]['title']}";
    
    if (!file_exists($folder)) {
        echo "\033[33m● Directory {$folder} not found!\033[0m\n";
        sleep(1);
        if (mkdir($folder, 0755, true)) {
            echo "\033[34m✔ Create Directory {$folder}\033[0m\n";
        } else {
            die("\033[31m✘ Failed to Create Directory {$folder}!\033[0m\n");
        }
    }
    
    if (empty($videoTimeEnd)) {
        exec("ffmpeg -i '$video' -ss $videoTimeStart -c copy '$folder/$videoTitle.mp4' $logLevel",  $output, $error);
        if ($error) {
            die("\033[31m✘ Failed to split $videoTitle!\033[0m\n");
        } else {
            echo "\033[36m$videoTitle \033[1;36m✔\033[0m\n";
            echo "\n\033[5;34mVideos are stored in the ".__DIR__."/$folder directory.\n";
        }
        
    } else {
        exec("ffmpeg -i '$video' -ss $videoTimeStart -to $videoTimeEnd -c copy '$folder/$videoTitle.mp4'  $logLevel",  $output, $error);
        if ($error) {
            die("\033[31m✘ Failed to split $videoTitle!\033[0m\n");
        } else {
            echo "\033[36m$videoTitle \033[1;36m✔\033[0m\n";
        }
    }
    
}
