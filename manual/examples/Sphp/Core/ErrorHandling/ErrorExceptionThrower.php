<?php

namespace Sphp\Core\ErrorHandling;

use Exception;
use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;

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
