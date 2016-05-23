<?php

namespace Sphp\Html\Apps;

//require_once '../settings.php';

//$size = new ViewportSizeViewer();
?>
<div class="row small-up-2">
  <div class="column callout error">

    <ul class="no-bullet">
      <li class="menu-text">MEDIA QUERY:</li>
      <li class="show-for-small-only">small screen</li>
      <li class="show-for-medium-only">medium screen</li>
      <li class="show-for-large-only">large screen</li>
      <li class="show-for-xlarge-only">x-large screen</li>
      <li><span class="show-for-xxlarge-only">xx-large screen</span></li>
      <li class="menu-text">ORIENTATION:</li>
      <li class="show-for-landscape"> landscape oriented</li>
      <li class="show-for-portrait"> portrait oriented</li>
    </ul>
    screen<span class="show-for-sr"> reader</span>.
  </div>
  <div class="column">
    <p>
      Screen size is: <?php $size->printHtml(); ?></p>

    <?php
    //(new MouseCoordinatesViewer())->setStyle("display", "inline-block")->printHtml();
    ?>
  </div>
</div>
