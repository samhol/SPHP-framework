<?php

namespace Sphp\Manual;

include_once __DIR__ . "/_constants.php";

//include_once __DIR__ . "/_common.php";
//include_once __DIR__ . '/../../sph/settings.php';

use Sphp\Html\Foundation\F6\Containers\ExceptionCallout as ExceptionCallout;
use Sphp\Html\Apps\Manual\Apis as Apis;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Core\Types\Strings as Strings;


function addPHPSuffix($page) {
  if (!Strings::endsWith($page, ".php")) {
    $page .= ".php";
  }
  return $page;
}

if (!isset($api)) {
$api = Apis::apigen(); 
// $api = new ApiGenLinker(Configuration::current()->get("apigen"));
}
if (!isset($php)) {
  $php = Apis::phpManual();
  //$php = new PHPManualLinker();
}
if (!isset($foundation)) {
  $foundation = Apis::foundation();
 // $foundation = new FoundationDocsLinker();
}
if (!isset($w3schools)) {
  $w3schools = Apis::w3schools();
 // $w3schools = new W3schoolsLinker();
}
if (!isset($parsedown)) {
  $parsedown = new \ParsedownExtraPlugin();
}
if (!isset($exampleViewer)) {
  $exampleViewer = new CodeExampleAccordion();
}
/**
 * Loads page
 * 
 * @param string $page
 */
$load = function($page) use ($api, $php, $foundation, $w3schools, $parsedown, $exampleViewer, &$load) {
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
    $content .= new ExceptionCallout($e);
  }
  ob_end_clean();
  echo $content;
};
