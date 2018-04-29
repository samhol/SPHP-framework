<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$thrower = ErrorToExceptionThrower::getDefault();
$thrower->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
$thrower->stop();

ErrorToExceptionThrower::getDefault(\Exception::class)->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
ErrorToExceptionThrower::getDefault(\Exception::class)->stop();
