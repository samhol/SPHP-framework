<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Manual\MVC\Intro\PackageListBuilder;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;

echo '<pre>';
//$p = new Packages();

$all = ParseFactory::fromFile('./composer.json');
$zends = Arrays::findKeysLike($all['require'], 'zendframework');

$plb = new PackageListBuilder();
$plb->getLinkTextBuilder()->setIcon('fab fa-github');
$plb->setUrlBuilder(function(string $package): string {
  return "https://github.com/$package";
});
//foreach ($zends as $component => $version) {
echo $plb->build($zends);
//$package = str_replace('zendframework/', '', $component);
 // $ul->appendLink("https://github.com/$component", Tags::span($fa->createIcon('fab fa-github'))->addCssClass('icon') . Tags::span($package)->addCssClass('text'));
//}