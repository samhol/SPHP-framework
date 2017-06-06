<?php

namespace Sphp\Db\Objects;

echo"<pre>";

$ar = array(
    array(1, 3),
    array(1, 2),
    array(3, 3),
    array(2, 122),
);

array_multisort($ar[0], SORT_ASC, SORT_STRING, $ar[1], SORT_NUMERIC, SORT_DESC);
//var_dump($ar);
echo"</pre>";
?>

<div class="button-group warning">
  <a class="button">Primary Action</a>
  <button type="button" class="dropdown button arrow-only">
    <span class="show-for-sr">Show menu</span>
  </button>
</div>
<span data-toggle="example-dropdown-1">Hoverable Dropdown</span>
<div class="dropdown-pane" id="example-dropdown-1" data-dropdown data-hover="true" data-hover-pane="true">
  Just some junk that needs to be said. Or not. Your choice.
</div>
