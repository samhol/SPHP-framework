<?php

namespace Sphp\Manual;

use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;
use Sphp\Core\Util\FileUtils;

include_once 'settings.php';
include_once __DIR__ . '/manualTools/main.php';
try {
  ob_start();
  $pageName = filter_input(\INPUT_GET, 'page');
  if ($errorCode !== NULL) {
    include(__DIR__ . '/error_docs/http_error.php');
  } else if ($pageName !== NULL) {
    $filename = "$pageName.php";
    $path = __DIR__ . '/pages/';
    if (!in_array($filename, FileUtils::dirToArray($path))) {
      include __DIR__ . '/error_docs/error.php';
    } else {
      include_once $path . $filename;
    }
  } else {
    include(__DIR__ . '/pages/index.php');
  }
  $content = ob_get_contents();
} catch (\Exception $e) {
  $content .= new ExceptionCallout($e);
}
ob_end_clean();
echo $content;
