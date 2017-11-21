<?php

namespace Sphp\MVC;

require_once('manual_helper_functions.php');

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

$loadNotFound = function () {
  include 'manual/templates/error.php';
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
    $content .= (new ThrowableCallout($e))->showInitialFile()->showTrace();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile()->showTrace();
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
        ->route('/index.php', $loadIndex, 10)
        ->route('/<!category>', $loadPage, 9);
