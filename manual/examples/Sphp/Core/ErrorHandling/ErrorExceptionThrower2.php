<?php

namespace Sphp\Core\ErrorHandling;

use Sphp\Html\Foundation\F6\Containers\ExceptionCallout;

ErrorExceptionThrower::Start(E_DEPRECATED);
try {
  $result = ereg("[^a-zA-Z0-9._-]", "123abc");
} catch (\Exception $ex) {
  (new ExceptionCallout($ex))->printHtml();
}
ErrorExceptionThrower::Stop();
