<?php

namespace Sphp\Stdlib;

echo"<pre>";

$s = new FormattableString('bar %d %s', [1]);
echo $s;
echo"</pre>";
?>

<div class="button-group warning">
  <a class="button">Primary Action</a>
  <button type="button" class="dropdown button arrow-only" data-toggle="example-dropdown-1">
    <span class="show-for-sr">Show menu</span>
  </button>
</div>
<span data-toggle="example-dropdown-1">Hoverable Dropdown</span>
<div class="dropdown-pane" id="example-dropdown-1" data-dropdown data-hover="true" data-hover-pane="true">
  Just some junk that needs to be said. Or not. Your choice.
</div>
