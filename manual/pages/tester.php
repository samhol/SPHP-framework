<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Manual\MVC\Intro\PackageLinkListBuilder;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Manual\MVC\Intro\GithubUrlBuilder;
echo '<pre class="vendor-readme-orbit sphp manual"><div class="orbit-container">';
//$p = new Packages();

$all = ParseFactory::fromFile('./composer.json');
$zends = Arrays::findKeysLike($all['require'], 'zendframework');

$plb = new PackageLinkListBuilder(new GithubUrlBuilder());
$plb->linkTextBuilder()->setIcon('fab fa-github');

echo $plb->build($zends)->addCssClass('packages');
echo '</div></pre>';
