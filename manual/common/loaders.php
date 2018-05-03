<?php

namespace Sphp\MVC;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

require_once('manual_helper_functions.php');

$loadNotFound = function () {
  include 'manual/templates/error.php';
};

$calendar = function ($par) {
  var_dump($par) ;
  include 'manual/pages/calendar-app.php';
};
$loadPage = function ($par, string $file = 'index') use($loadNotFound) {
  //var_dump(func_get_args());
  try {
    ob_start();
    $page = "manual/pages/$file.php";
    if (is_file($page)) {
      include $page;
    } else {
      $loadNotFound($par);
    }
    $content = ob_get_contents();
  } catch (\Throwable $e) {
    $content = ThrowableCalloutBuilder::build($e, true, true);
  }
  ob_end_clean();
  echo $content;
};
$loadIndex = function () use ($loadPage) {
  $loadPage('index');
};

$router = (new Router())
        ->setDefaultRoute($loadNotFound)
        ->route('/', $loadIndex)
        ->route('/calendar/<*categories>', $calendar)
        ->route('/index.php', $loadIndex, 10)
        ->route('/<!category>', $loadPage, 9);
