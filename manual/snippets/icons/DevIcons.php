<?php
require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Media\Icons\DevIcons;

$data = Parser::fromFile('DevIcons.json');
  \Sphp\Manual\md('##Devicons');
?>
<div class="grid-x small-up-3 medium-up-5 large-up-8 icon-examples">
  <?php
// print_r($data);

  foreach ($data as $item) {
    $name = $item['name'];
    // echo "\n$name";
    foreach ($item['versions']['font'] as $version) {
      //   echo "\ndevicon-$name-$version";
      $method = $name . ucfirst($version);

      echo '<div class="cell"><div class="icon-container"><div class="icon">';
      echo DevIcons::$method("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
      echo '</div></div></div>';
    }
  }
  ?>

</div>
