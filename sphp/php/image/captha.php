<?php

namespace Sphp\Images;

include_once '../settings.php';

$width = isset($_GET['width']) ? intval($_GET['width']) : 120;
$height = isset($_GET['height']) ? intval($_GET['height']) : 50;
$characters = isset($_GET['length']) && $_GET['length'] > 1 ? intval($_GET['length']) : 6;
//echo "egrger";
(new CaptchaImage())->draw($width, $height, $characters);