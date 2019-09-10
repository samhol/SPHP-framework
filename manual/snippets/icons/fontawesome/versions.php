<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\FaIconGroup;

$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => null]);
//var_dump($type, $typeMap[$type]);
$show = $typeMap[$type];

$headingNote = ucfirst($type);


$iconsData = DataFactory::fontawesomeFromYaml('/home/int48291/public_html/playground/manual/snippets/icons/fontawesome/icons.yml')
        ->filter(function(IconGroup $iconData) use ($type) {
  if ($iconData instanceof FaIconGroup) {
    return in_array($type, $iconData->getStyles());
  }
  return false;
});

use Sphp\Manual\Apps\Icons\Views\IconsView;

$iconsView = new IconsView();
$iconsView->setHeading('Fontawesome <small>' . ucfirst($type) . ' Icons</small>');
echo $iconsView->getHtmlFor($iconsData);
