<?php

namespace Sphp\Manual;

include_once __DIR__ . "/_constants.php";

use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Stdlib\Strings;

function addPHPSuffix($page) {
  if (!Strings::endsWith($page, ".php")) {
    $page .= ".php";
  }
  return $page;
}

if (!isset($api)) {
  $api = Apis::apigen();
}
if (!isset($php)) {
  $php = Apis::phpManual();
}
if (!isset($foundation)) {
  $foundation = Apis::foundation();
}
if (!isset($w3schools)) {
  $w3schools = Apis::w3schools();
}
if (!isset($parsedown)) {
  $parsedown = \ParsedownExtraPlugin::instance();
}
/**
 * Loads page
 * 
 * @param string $page
 */
$load = function($page) use ($api, $php, $foundation, $w3schools, $parsedown, &$load) {
  try {
    ob_start();
    $page = addPHPSuffix($page);
    $examplePath = \Sphp\Manual\EXAMPLE_FOLDER . "/" . $page;
    $pagePath = \Sphp\Manual\PAGE_FOLDER . "/" . $page;
    if (is_file($examplePath)) {
      include($examplePath);
    } else if (is_file($pagePath)) {
      include($pagePath);
    } else {
      throw new \InvalidArgumentException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ExceptionCallout($e))->showInitialFile();
  }
  ob_end_clean();
  echo $content;
};
