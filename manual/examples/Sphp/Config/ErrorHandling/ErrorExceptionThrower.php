<?php

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;

ErrorExceptionThrower::Start();
try {
  include("missing/file.php");
} catch (Throwable $ex) {
  (new ExceptionCallout($ex))
          ->showInitialFile(false)
          ->showTrace(false)
          ->printHtml();
}
ErrorExceptionThrower::Stop();
?>