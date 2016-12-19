<?php

use Sphp\Core\Http\HttpCodeCollection;

include_once 'Viewer.php';

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);

if ($errorCode !== null) {
  $p = new HttpCodeCollection();
  $w = new Viewer($p->getCode($errorCode));
  $w->printHtml();
}