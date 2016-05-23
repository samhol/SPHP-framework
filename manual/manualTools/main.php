<?php

namespace Sphp\Manual;

include_once __DIR__ . "/_constants.php";

//include_once __DIR__ . "/_common.php";
//include_once __DIR__ . '/../../sph/settings.php';

use Sphp\Html\Foundation\F6\Containers\ExceptionCallout as ExceptionCallout;
use Sphp\Core\Configuration as Config;
use Sphp\Html\Apps\ApiTools\ApiGenLinker as ApiGenLinker;
use Sphp\Html\Apps\ApiTools\FoundationDocsLinker as FoundationDocsLinker;
use Sphp\Html\Apps\ApiTools\W3schoolsLinker as W3schoolsLinker;
use Sphp\Html\Apps\ApiTools\PHPManualLinker as PHPManualLinker;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Util\Strings as Strings;

class ExampleViewer extends CodeExampleAccordion {

  /**
   * {@inheritdoc}
   */
  public function fromFile($path, $highlightOutput = false, $outputAsHtmlFlow = true) {
    if (class_exists($path)) {
      $path = Strings::replace("\\", "/", $path) . ".php";
    }
    parent::fromFile($path, $highlightOutput, $outputAsHtmlFlow);
    return $this;
  }

}

function addPHPSuffix($page) {
  if (!Strings::endsWith($page, ".php")) {
    $page .= ".php";
  }
  return $page;
}

if (!isset($api)) {
  $api = new ApiGenLinker(Config::current()->get("apigen"));
}
if (!isset($php)) {
  $php = new PHPManualLinker();
}
if (!isset($foundation)) {
  $foundation = new FoundationDocsLinker();
}
if (!isset($w3schools)) {
  $w3schools = new W3schoolsLinker();
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
