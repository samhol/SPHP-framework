<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');


use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\Views\IconsView;

$iconsData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');

$iconsView = new IconsView();
echo $iconsView->getHtmlFor($iconsData);
