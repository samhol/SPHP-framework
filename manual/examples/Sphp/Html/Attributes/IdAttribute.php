<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

$id = new IdAttribute("id", "a b");
echo "<div $id>$id</div>\n";
$id->identify();
echo "<div $id>$id</div>\n";


try {
  $id->set("email");
  echo "<div $id>$id</div>\n";
} catch (\Exception $ex) {
  echo new ThrowableCallout($ex);
}
