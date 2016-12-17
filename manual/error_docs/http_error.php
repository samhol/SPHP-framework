<?php

use Sphp\Core\Http\HttpErrorParser;

include_once 'Viewer.php';

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);

if ($errorCode !== null) {
  $p = new HttpErrorParser();
  $w = new Viewer($p->getHttpCode($errorCode));
  $w->printHtml();
}