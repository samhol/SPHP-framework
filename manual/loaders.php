<?php

namespace Sphp\MVC;

require_once('manualTools/main.php');

use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;
use Sphp\Html\Apps\Manual\Apis;

$loadNotFound = function () {

  include 'manual/templates/error.php';
};
$loadPage = function ($par, $file = 'index') use($loadNotFound, $load) {
  //print_r(func_get_args());
  $parsedown = \ParsedownExtraPlugin::instance();
  $w3schools = Apis::w3schools();
  $api = Apis::sami();
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
  } catch (\Throwable $e) {
    $content .= (new ExceptionCallout($e))->showInitialFile()->showTrace();
  } catch (\Exception $e) {
    $content .= (new ExceptionCallout($e))->showInitialFile()->showTrace();
  }
  ob_end_clean();
  echo $content;
};

$loadIndex = function () use ($loadPage, $load) {
  $loadPage('index');
};


