<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

ErrorExceptionThrower::Start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  (new ThrowableCallout($ex))
          ->showInitialFile(false)
          ->showTrace(false)
          ->printHtml();
}
ErrorExceptionThrower::Stop();
