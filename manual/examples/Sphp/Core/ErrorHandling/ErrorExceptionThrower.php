<?php

namespace Sphp\Core\ErrorHandling;

use Exception;
use Sphp\Html\Foundation\F6\Containers\ExceptionCallout;

ErrorExceptionThrower::Start();
try {
  include("missing/file.php");
} catch (Exception $ex) {
  (new ExceptionCallout($ex))
          ->showInitialFile(false)
          ->showTrace(false)
          ->printHtml();
}
ErrorExceptionThrower::Stop();
