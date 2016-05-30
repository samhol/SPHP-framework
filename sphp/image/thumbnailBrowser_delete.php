<?php

namespace Sphp\Html;
include_once("../settings.php");


use Sphp\Core\Types\Arrays as Arrays;
use Sphp\Html\ImgTag as Img;

$get = Arrays::map($_GET, array('xssClean'));

header("Content-type: text/plain; charset=utf-8");
if ($get["folder"] && is_string($_GET["folder"])) {
	if ($_GET["folder"] && strncmp(ALBUM_PATH, $folder, strlen(ALBUM_PATH)) == 0) {
		echo implode("", (new PhotoAlbum)->getThumbnailImages("../" . $_GET["folder"]));
	}
}
?>