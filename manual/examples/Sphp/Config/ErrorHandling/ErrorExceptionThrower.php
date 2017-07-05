<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

$thrower = new ErrorExceptionThrower();
$thrower->start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  (new ThrowableCallout($ex))
          ->showInitialFile(false)
          ->showTrace(false)
          ->printHtml();
}
$thrower->stop();
