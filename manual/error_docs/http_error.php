<?php

use Sphp\Core\Http\HttpErrorParser;
use Zend\Http\Response;
use Zend\Http\Request;
include_once 'Viewer.php';

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
$resp = new Request();

$r = new Response();
echo $r->getStatusCode();
if ($errorCode !== null) {
  $p = new HttpErrorParser();
  $w = new Viewer($p, $errorCode);
  $w->printHtml();
}