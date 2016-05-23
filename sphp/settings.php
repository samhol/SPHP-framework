<?php

/**
 * This file holds the common settings to the PHP project
 */
//include_once("../vendor/autoload.php");

require_once __DIR__ . '/../vendor/autoload.php';
require_once("applicationConstants.php");
//use Sphp\Html\Programming\Scripts as Scripts;

/*\Sphp\System\Config::obtain("production")["VENDOR_SCRIPTS"] = [
      Scripts::FAST_CLICK => \Sphp\js\VENDOR_PATH . "fastclick.min.js",
      Scripts::MODERNIZR => \Sphp\js\VENDOR_PATH . "modernizr.min.js",
      Scripts::JQUERY => \Sphp\js\VENDOR_PATH . "jquery-1.11.3.min.js",
      Scripts::FOUNDATION => \Sphp\js\VENDOR_PATH . "foundation.all.min.js",
      Scripts::QTIP => \Sphp\js\VENDOR_PATH . "modernizr.js",
      Scripts::ION_RANGESLIDER => \Sphp\js\VENDOR_PATH . "ion.rangeSlider.min",
      Scripts::ANYTIME_C => \Sphp\js\VENDOR_PATH . "anytime.c.min",
      Scripts::QTIP => \Sphp\js\VENDOR_PATH . "jquery.qtip.min.js",
      Scripts::ZERO_CLIPBOARD => \Sphp\js\VENDOR_PATH . "ZeroClipboard.min.js",
      Scripts::SPHP_ALL => \Sphp\js\VENDOR_PATH . "sphp.min.js"
  ];*/
/*set_include_path(Sphp\PHP_PACKAGES);
require_once Sphp\PHP_PACKAGES . "/Symfony/Component/ClassLoader/UniversalClassLoader.php";

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Sphp', Sphp\SPH_PACKAGE);
$loader->registerNamespace('Imagine', Sphp\PHP_PACKAGES . "/Imagine");
$loader->registerNamespace('Symfony', Sphp\PHP_PACKAGES . "/Symfony");
$loader->registerNamespace('Gajus', Sphp\PHP_PACKAGES . "/Gajus");
$loader->registerNamespace('Sepia', Sphp\PHP_PACKAGES . "/Sepia");
$loader->useIncludePath(true);
$loader->register();

include_once(Sphp\PHP_PACKAGES . "/geshi/geshi.php");
include_once(Sphp\PHP_PACKAGES . "/ParseDown/Parsedown.php");
include_once(Sphp\PHP_PACKAGES . "/ParseDown/ParsedownExtra.php");
include_once(Sphp\PHP_PACKAGES . "/sql-formatter/SqlFormatter.php");*/

?>
