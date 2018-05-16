<?php

namespace Sphp\Html\Media\Icons;

require_once('../../settings.php');

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Stdlib\Arrays;

$faData = Parser::fromFile('font-awesome.json');
//$d = $json->fromFile('manual/snippets/icons.json');
//print_r($data);
$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => null]);
if (array_key_exists($type, $types)) {
  $headingNote = $types[$type];
  $data = Arrays::isLike($faData['icons'], "$type ");
} else {
  $data = $faData['icons'];
  $headingNote = 'All';
}
\Sphp\Manual\md("##Font Awesome: <small>$headingNote icons</small>");
?>
<div class="sphp-icon-examples grid-x small-up-3 medium-up-5 large-up-8">
  <?php
  foreach ($data as $item) {
    $name = str_replace(['fas', 'far', 'fab', ' fa-'], '', $item);
    echo '<div class="cell"><div class="icon-container">';
    echo (new Icon($item, "$item icon"))->setAttribute('title', $item . " icon");
    echo "<div class=\"ext\">$item</div>";
    echo '</div></div>';
  }
  ?>

</div>
