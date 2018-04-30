<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$thrower = ErrorToExceptionThrower::getInstance();
$thrower->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
$thrower->stop();

ErrorToExceptionThrower::getInstance(\Exception::class)->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
ErrorToExceptionThrower::getInstance(\Exception::class)->stop();
