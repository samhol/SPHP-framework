<?php

namespace Sphp\Html;

require_once('settings.php');

use Sphp\Html\Head\Link;
use Sphp\Html\Head\Meta;
$doc = new SphpDocument();
$html = $doc->html();
$head = $doc->head();
$body = $doc->body();

$html->setLanguage('en');

$head->set(Meta::charset('UTF-8'));
$head->set(Meta::viewport('width=device-width, initial-scale=1.0'));
$head->setDocumentTitle('Privacy policy | SPHPlayground framework');

$head->set(Link::stylesheet('/manual/css/license/license.css'));

$head->set(Link::appleTouchIcon('/apple-touch-icon.png'));
$head->set(Link::icon('/favicon-32x32.png', '32x32'));
$head->set(Link::icon('/favicon-16x16.png', '16x16'));
$head->set(Link::manifest('/site.webmanifest'));
$head->set(Link::maskIcon('/safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));

$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['privacy', 'policy', 'license', 'SPHPlayground']));
$head->set(Meta::description('Privacy policy of SPHPlayground framework manual web site'));

$doc->useFontAwesome();
$doc->body()->addCssClass('mit-license');
$doc->startBody();

use Sphp\Html\Foundation\Sites\Grids\DivGrid;

$main = Tags::main();
$main->appendSection()->appendMdFile('privacy_policy.md');
$main->append('<hr>');
$linkBar = new Foundation\Sites\Buttons\ButtonGroup();
$linkBar->addCssClass('float-center');
$linkBar->appendPushButton('<i class="fas fa-arrow-left fa-lg"></i> Back')->setAttribute('onclick', 'window.history.back();');
$linkBar->appendHyperlink('/', Media\Icons\FontAwesome::home()->setSize('lg') . ' Back to Manual');
$linkBar->appendHyperlink('https://github.com/samhol/SPHP-framework', Media\Icons\FontAwesome::github()->addCssClass('border')->setSize('lg') . ' repository');


$main->append($linkBar);
$grid = DivGrid::from([$main]);
echo $grid;

echo $html->getDocumentClose();
