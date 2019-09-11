<?php

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\FaIconGroup;

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
$iconsData = $iconsData->filter(function(IconGroup $iconData) use ($type) {
  if ($iconData instanceof FaIconGroup) {
    return in_array($type, $iconData->getStyles());
  }
  return false;
});
$info = new Sphp\Manual\Apps\Icons\Views\InfoVievs();

echo '<div class="icon-info-popup">'. $info->createHtmlFor($iconsData->getGroup('address-book'))."</div>";
//var_dump($iconsData);
//$show = $typeMap[$type];
use Sphp\Manual\Apps\Icons\Views\IconsView;
$cells = new IconsView();
$cells->setHeading('Fontawesome <small>Regular Icons</small>');
$devData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
echo $cells->getHtmlFor($controller->getData($type));
echo (new IconsView())->getHtmlFor($iconsData);
