<?php

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\IconInformation;
use Sphp\Manual\Apps\Icons\FaIconInformation;

echo '<pre>';
$iconsData = DataFactory::fontawesomeFromYaml('/home/int48291/public_html/playground/manual/snippets/icons/fontawesome/icons.yml');
$controller = new \Sphp\Manual\Apps\Icons\FaGroupController($iconsData);
$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => 'regular']);
if ($type === null) {
  $type = 'regular';
}
echo '</pre>';
$iconsData = $iconsData->filter(function(IconInformation $iconData) use ($type) {
  if ($iconData instanceof FaIconInformation) {
    return in_array($type, $iconData->getStyles());
  }
  return false;
});
//var_dump($iconsData);
//$show = $typeMap[$type];

$cells = new Sphp\Manual\Apps\Icons\Views\FaIconsView($iconsData);
$devData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
echo $cells->getHtmlFor($controller->getData($type));
echo (new Sphp\Manual\Apps\Icons\Views\IconsView($devData))->getHtmlFor($controller->getData($type));;
