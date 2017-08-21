<?php

namespace Sphp\Manual;

//include_once __DIR__ . "/_constants.php";

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Sphp\Stdlib\Strings;

function addPHPSuffix($page) {
  if (!Strings::endsWith($page, ".php")) {
    $page .= ".php";
  }
  return $page;
}

function parseDown(string $content) {
  echo \ParsedownExtraPlugin::instance()->text($content);
}


use Sphp\Stdlib\Filesystem;

/**
 * Loads page
 * 
 * @param string $page
 */
/*$load = function($page) use ($parsedown, &$load) {
  try {
    ob_start();
    //echo get_include_path();
    $page = addPHPSuffix($page);
    //$examplePath = \Sphp\Manual\EXAMPLE_FOLDER . "/" . $page;
    $pagePath = "$page";
    //if (is_file($examplePath)) {
    // include($examplePath);
    //} else 
    if (Filesystem::isFile($pagePath)) {
      include($pagePath);
    } else {
      throw new \InvalidArgumentException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile();
  }
  ob_end_clean();
  echo $content;
};*/

function loadPage(string $page) {
  try {
    ob_start();
    //echo get_include_path();
    $page = addPHPSuffix($page);
    //$examplePath = \Sphp\Manual\EXAMPLE_FOLDER . "/" . $page;
    $pagePath = "$page";
    //if (is_file($examplePath)) {
    // include($examplePath);
    //} else 
    if (Filesystem::isFile($pagePath)) {
      include($pagePath);
    } else {
      throw new \InvalidArgumentException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile();
  }
  ob_end_clean();
  echo $content;
}

;
