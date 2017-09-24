<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;
use Sphp\Stdlib\Networks\URL;
echo "<pre>";
print_r($_SERVER);
var_dump(URL::getCurrentURL());
$href = URL::getCurrentURL(true);
echo "<a href=\"$href\">ebrthd</a>";
?>
</pre>
<div class="grid-example">
  <div class="grid-x grid-margin-x">
    <div class="small-12 cell">4 cells</div>
    <div class="auto cell">Whatever's left!</div>
    <div class="auto cell">Whatever's left!</div>
  </div>
</div>
scheme://[user:pass@]domain:port/path?query#fragment

