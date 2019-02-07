<?php

namespace Sphp\Html\Media\Icons;

require_once('../../settings.php');

use Sphp\Stdlib\Parsers\Parser;

$faData = Parser::fromFile('font-awesome.json');
//$d = $json->fromFile('manual/snippets/icons.json');
//print_r($data);
$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => null]);
if (array_key_exists($type, $types)) {
  $headingNote = $types[$type];
  $searched = preg_quote($type, '/');
  $input = preg_quote($searched, '~');
  $data = preg_grep('~' . $input . '~', $faData['icons']);
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
    echo '<div class="cell"><div class="icon-container"><div class="icon">';
    echo (new FontIcon($item, "$item icon"))->setAttribute('title', $item . " icon");
    echo "</div><div class=\"ext\">$item</div>";
    echo '</div></div>';
  }
  ?>

</div>
