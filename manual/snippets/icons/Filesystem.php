<?php

namespace Sphp\Html\Media\Icons;
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../../settings.php');

include 'filetypes.php';
asort($mime_types);
echo "<pre>";
foreach ($mime_types as $name => $mime) {
  //echo "'$name' => '$mime',\n";
}
echo "</pre>";
\Sphp\Manual\md(<<<MD
        
##Filetype icons
MD
);
?>
<div class="sphp-icon-examples grid-x small-up-3 medium-up-5 large-up-8">
  <?php
  foreach ($mime_types as $name => $mime) {
    echo '<div class="cell"><div class="icon-container">';
    echo Filetype::$name($mime)->setAttribute('title', "$name: $mime");
    echo '</div></div>';
  }
  ?>

</div>
