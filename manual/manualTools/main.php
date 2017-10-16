<?php

namespace Sphp\Manual;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\InvalidArgumentException;
use ParsedownExtraPlugin;

/**
 * 
 * @param string $content
 */
function parseDown(string $content) {
  echo ParsedownExtraPlugin::instance()->text($content);
}

/**
 * 
 * @param  string $page
 * @throws InvalidArgumentException
 */
function loadPage(string $page) {
  try {
    ob_start();
    if (!Strings::endsWith($page, '.php')) {
      $page .= '.php';
    }
    $pagePath = "$page";
    if (Filesystem::isFile($pagePath)) {
      include($pagePath);
    } else {
      throw new InvalidArgumentException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile()->showTrace();
  }
  ob_end_clean();
  echo $content;
}

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Manual\Sami\Sami;
use Sphp\Html\Apps\Manual\PHPManual\PHPManual;
use Sphp\Html\Apps\Manual\W3schools;

/**
 * Return the default SPHP framework API linker
 * 
 * @return Sami 
 */
function api(): Sami {
  return Apis::sami();
}

/**
 * Return the PHP manual API linker
 * 
 * @return PHPManual 
 */
function php(): PHPManual {
  return Apis::phpManual();
}

/**
 * Return the W3Schools API linker
 * 
 * @return W3schools 
 */
function w3schools(): W3schools {
  return Apis::w3schools();
}
