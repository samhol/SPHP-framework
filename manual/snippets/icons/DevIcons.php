<?php
require_once('../../settings.php');

\Sphp\Manual\md('##Devicons');

use Sphp\Stdlib\Parser;
use Sphp\Html\Media\Icons\DevIcons;

$data = Parser::fromFile('DevIcons.json');
?>
<div class="sphp-icon-examples grid-x small-up-3 medium-up-5 large-up-8">
  <?php
// print_r($data);

  foreach ($data as $item) {
    $name = $item['name'];
    // echo "\n$name";
    foreach ($item['versions']['font'] as $version) {
      //   echo "\ndevicon-$name-$version";
      $method = $name . ucfirst($version);

      echo '<div class="cell"><div class="icon-container">';
      echo DevIcons::$method("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
      echo '</div></div>';
    }
  }
  ?>

</div>
