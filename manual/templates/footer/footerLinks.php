<?php

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

$footerData = ParseFactory::yaml()->fileToArray('/home/int48291/public_html/playground/manual/yaml/footer.yml');
/* echo '<pre>';
  print_r($footerData);
  echo "</pre>";
 */
$mb = new MenuBuilder();

include './manual/templates/footer/linksForSmall.php';
include './manual/templates/footer/linksForMediumUp.php';
