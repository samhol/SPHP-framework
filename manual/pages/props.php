<?php

namespace Sphp\Html\Media\ImageMap;

var_dump(explode(',', null));
var_dump(explode(',', 2));
var_dump(explode(',', 2));
try {

  $attr = new CoordinateAttribute('coords');
  $attr->set(new \stdClass());
} catch (\Exception $ex) {
  echo $ex->getMessage();
}
?>
</pre>
