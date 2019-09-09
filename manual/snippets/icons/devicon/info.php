<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\Views\IconGroupInfoViewBuilder;

if (!filter_has_var(INPUT_GET, 'iconSet')) {
  echo 'IconSet was not given!';
}
if (filter_has_var(INPUT_GET, 'name')) {
  $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
  $iconsData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
  $iconData = $iconsData->getGroup($name);
  if ($iconData === null) {
    echo 'Icongroup ' . $name . ' was not found!';
  } else {
    $view = new \Sphp\Manual\Apps\Icons\Views\InfoVievs();
    $view->associate('Font Awesome', new IconGroupInfoViewBuilder());
    echo $view->createHtmlFor($iconData);
  }
} else {
  echo 'IconName was not given!';
}
