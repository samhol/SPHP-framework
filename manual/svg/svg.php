<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Validators\Range;
use Sphp\Html\Media\Image\SvgLoader;
use Sphp\Exceptions\FileSystemException;
use Sphp\Html\Media\Icons\Crossbones;

//$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
//var_dump($redirect);
//$seed = explode('/',trim($redirect));
//var_dump($seed);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$colorOptions = [
    'options' =>
    [
        'default' => '68B604',
        'regexp' => '/^([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b$/'
    ]
];

$rangeValidator = new Range(0, 1, true);

$title = filter_input(INPUT_GET, 'title', FILTER_VALIDATE_FLOAT);
$color = filter_input(INPUT_GET, 'color', FILTER_VALIDATE_REGEXP, $colorOptions);
$opacity = filter_input(INPUT_GET, 'opacity', FILTER_VALIDATE_FLOAT);
if (!$rangeValidator->isValid($opacity)) {
  $opacity = null;
}

//$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);

function getPath(): string {
  $path = '/home/int48291/public_html/playground/manual/svg/';
  if (isset($_GET['devicon'])) {
    $name = filter_input(INPUT_GET, 'devicon', FILTER_SANITIZE_STRING);
    $parts = explode('-', $name);
    $path .= 'devicons/' . $parts[0] . "/$name.svg";
  } else if (isset($_GET['flag'])) {
    $flag = filter_input(INPUT_GET, 'flag', FILTER_SANITIZE_STRING);
    $path .= "flags/$flag.svg";
  } else if (isset($_GET['name'])) {
    $file = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
    $path .= "$file.svg";
  }
  if (!is_file($path)) {
    throw new FileSystemException("invalid SVG $path");
  }
  return $path;
}

//echo $name;
//var_dump($name);
try {
  $path = getPath();
  $object = SvgLoader::instance()->fileToObject($path);
} catch (\Exception $ex) {
  $object = new Crossbones();
  $object->setColor('#f00')->setOpacity(.4);
  $object->setText('SVG image not found!');
  $title = 'SVG image resource not found!';
}
if ($opacity !== null) {
  $object->setOpacity($opacity);
}
if ($title !== null) {
  $object->setTitle($title);
}
header('Content-type: image/svg+xml');

echo '<?xml version="1.0"?>' . $object;

