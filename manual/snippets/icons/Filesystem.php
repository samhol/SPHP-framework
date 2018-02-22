<?php

namespace Sphp\Html\Media\Icons;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../../settings.php');

use Sphp\Stdlib\Readers\Yaml;

$yaml = new Yaml();

$d = $yaml->fromFile('../filetypes.yml');


\Sphp\Manual\md(<<<MD
        
##Filetype icons
MD
);
?>

<?php
foreach ($d as $name => $group) {
  echo "<h3>$name</h3>";
  echo '<div class="sphp-icon-examples grid-x small-up-3 medium-up-5 large-up-8">';
  foreach ($group as $ext => $description) {
    echo '<div class="cell"><div class="icon-container">'; 
    echo "<div class=\"ext\">.$ext</div>";
    echo Filetype::$ext($description)->setAttribute('title', "$ext: $description");
    echo '</div></div>';
  }
  echo '</div>';
}
