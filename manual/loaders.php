<?php

namespace Sphp\MVC;

require_once('manualTools/main.php');

use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;
use Sphp\Html\Container;
use Sphp\Stdlib\Path;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$loadNotFound = function () {
  $page = Path::get()->local('manual/templates/error.php');
  echo 'erh<z';
  include $page;
};
$loadPage = function ($par, $file = 'index') use($loadNotFound, $load) {
  //print_r(func_get_args());
  $parsedown = \ParsedownExtraPlugin::instance();
  $w3schools = Apis::w3schools();
  $api = Apis::apigen();
  $exampleViewer = new CodeExampleAccordion();
  // echo $page. $file;
  try {
    ob_start();
    //var_dump(is_file("manual/pages/$file.php"));
    $page = "manual/pages/$file.php";
    //echo $page . $file;
    if (is_file($page)) {
      include $page;
    } else {
      echo $page;
      $loadNotFound($par);
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= new ExceptionCallout($e);
  }
  ob_end_clean();
  echo $content;
};

$loadIndex = function () use ($loadPage, $load) {
  $loadPage('index');
};


