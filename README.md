# Video Splitter

A simple command line PHP script that splits a video into parts based on a timeline.

This script aims to break down videos based on timelines such as long videos, tutorials and the like that have timelines like YouTube Videos Segments.

> The script uses [FFMpeg](https://ffmpeg.org) so you have to install it.

Let's get started then! :smiley:


## Installation

Download the [video-splitter.php](https://github.com/nsmle/video-splitter/blob/4e8afe8cdb72e1003a251d3c9972b770dba9da7e/video-splitter.php) file with the following command
```bash
wget https://raw.githubusercontent.com/nsmle/video-splitter/4e8afe8cdb72e1003a251d3c9972b770dba9da7e/video-splitter.php
```

or, Clone this repository
```bash
git clone https://github.com/nsmle/video-splitter.git
```

## Usage

Replace [XXXXXX](https://github.com/nsmle/video-splitter/blob/4e8afe8cdb72e1003a251d3c9972b770dba9da7e/video-splitter.php#L18) in `$video` with the video directory to be split. e.g.
```php
$video = "~/.local/share/videos/video.mp4";
```

Replace [XXXXXX](https://github.com/nsmle/video-splitter/blob/master/video-splitter.php#L21) in `$folder` with desired directory as result of split video. If the directory does not exist, it will be created. e.g.
```php
$folder = "~/.local/share/videos/split";
```

Replace [XXXXXX](https://github.com/nsmle/video-splitter/blob/master/video-splitter.php#L32) in `$timeline` with the timeline of the video to be split. e.g.
```php
$timeline = <<<TIMELINE
00:00:00 - Video split 1
00:02:56 - Video split 2
00:14:56 - Video split 3
00:24:56 - Video split 4
TIMELINE;
```

To start the split, run the following command.
```bash
php video-splitter.php
```

You can set the log level of FFmpeg by setting it in `$logLevel`. as default logLevel will be set on error.

## Installing FFmpeg

#### Installing FFmpeg on Ubuntu 
- Start by updating the packages list:
```bash
sudo apt update
```
- Next, install FFmpeg by typing the following command:
```bash
sudo apt install ffmpeg
```
- To validate that the package is installed properly use the ffmpeg -version command which prints the FFmpeg version:
```bash
ffmpeg -version
```
- The output should look something like this:
```bash
ffmpeg version 4.2.4-1ubuntu0.1 Copyright (c) 2000-2020 the FFmpeg developers
built with gcc 9 (Ubuntu 9.3.0-10ubuntu2)
```



#### Installing FFmpeg on Termux 
- Start by updating the packages list:
```bash
pkg update && pkg upgrade -y
```
- Next, install FFmpeg by typing the following command:
```bash
pkg install ffmpeg
```
- To validate that the package is installed properly use the ffmpeg -version command which prints the FFmpeg version:
```bash
ffmpeg -version
```
- The output should look something like this:
```bash
ffmpeg version 4.4.1 Copyright (c) 2000-2021 the FFmpeg developers
built with Android (7714059, based on r416183c1)
```


See [FFmpeg installation guide](https://www.ffmpeg.org/download.html) for details.
