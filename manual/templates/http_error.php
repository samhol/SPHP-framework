<?php

use Sphp\Core\Http\HttpCodeCollection;
use Sphp\Manual\MVC\Errors\HttpErrorViewer;
//include_once 'HttpErrorViewer.php';

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);

if ($errorCode !== null) {
  $p = new HttpCodeCollection();
  $w = new HttpErrorViewer($p->getCode($errorCode));
  $w->printHtml();
}