<?php

namespace Sphp\Html\Media\Icons;

require_once('../../settings.php');

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

use Sphp\Stdlib\Readers\Yaml;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\Icon;

$yaml = new Yaml();

$faData = $yaml->fromFile('icons.yml');
//$d = $json->fromFile('manual/snippets/icons.json');
//print_r($data);


\Sphp\Manual\md(<<<MD
        
##Font Awesome icons
 
MD
);
?>
<div class="sphp-icon-examples grid-x small-up-3 medium-up-5 large-up-8">
<?php
foreach ($faData as $name => $item) {
  if (isset($item['styles'])) {
    $icon_name = "fa-$name";
    foreach ($item['styles'] as $styleName) {
      if ($styleName === 'brands' || $styleName === 'solid') {
        echo '<div class="cell"><div class="icon-container">';
        if ($styleName === 'brands') {
          echo (new Icon(['fab', $icon_name], "$icon_name icon"))->setAttribute('title', $item['label'] . " icon");
        } else if ($styleName === 'solid') {
          echo (new Icon(['fas', $icon_name], "$icon_name icon"))->setAttribute('title', $item['label'] . " icon");
        }
        echo '</div></div>';
      }
    }
  } else {
    echo $item['label'];
  }
}
?>

</div>
