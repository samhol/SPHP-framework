<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$thrower = new ErrorExceptionThrower();
$thrower->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
$thrower->stop();
