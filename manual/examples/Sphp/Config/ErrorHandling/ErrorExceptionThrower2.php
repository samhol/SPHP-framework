<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Containers\ExceptionCallout;

ErrorExceptionThrower::Start(E_DEPRECATED);
try {
  $result = ereg("[^a-zA-Z0-9._-]", "123abc");
} catch (\Throwable $ex) {
  (new ExceptionCallout($ex))->printHtml();
}
ErrorExceptionThrower::Stop();
?>