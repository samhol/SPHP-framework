<?php

namespace Sphp\Html;

error_reporting(E_ALL);
ini_set("display_errors", "1");
include_once("../settings.php");

header("Content-type: text/plain; charset=utf-8");
$src = filter_input(\INPUT_GET, "src", \FILTER_SANITIZE_STRING);
echo PhotoAlbum::getImageInfoTable("../../" . $src);
?>