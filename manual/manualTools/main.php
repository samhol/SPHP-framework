<?php

namespace Sphp\Manual;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Filesystem;
use Sphp\Html\Apps\Manual\Apis;

function api() {
  return Apis::sami();
}

/**
 * 
 * @param string $content
 */
function parseDown(string $content) {
  echo \ParsedownExtraPlugin::instance()->text($content);
}

/**
 * 
 * @param string $page
 * @throws \Sphp\Exceptions\RuntimeException
 */
function loadPage(string $page) {
  try {
    ob_start();
    if (!Strings::endsWith($page, ".php")) {
      $page .= ".php";
    }
    $pagePath = "$page";
    if (Filesystem::isFile($pagePath)) {
      include($pagePath);
    } else {
      throw new \Sphp\Exceptions\RuntimeException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile();
  }
  ob_end_clean();
  echo $content;
}
