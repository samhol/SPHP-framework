<?php

namespace Sphp\Html;

require_once('settings.php');

use Sphp\Html\Head\Link;
use Sphp\Html\Head\Meta;

$doc = SphpDocument::create();
$html = $doc->html();
$head = $doc->html()->head();
$body = $doc->html()->body();

$doc->setLanguage('en');

$head->set(Meta::charset('UTF-8'));
$head->set(Meta::viewport('width=device-width, initial-scale=1.0'));
$doc->setDocumentTitle('License | SPHPlayground framework');

$head->set(Link::stylesheet('/manual/css/license/license.css'));
//$head->setCssSrc('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css');

$head->set(Link::appleTouchIcon('../apple-touch-icon.png'));
$head->set(Link::icon('../favicon-32x32.png', '32x32'));
$head->set(Link::icon('../favicon-16x16.png', '16x16'));
$head->set(Link::manifest('../site.webmanifest'));
$head->set(Link::maskIcon('../safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));

$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['MIT', 'license', 'SPHPlayground']));
$head->set(Meta::description('License for SPHPlayground framework'));

$doc->useFontAwesome('9e1f35bc72');
$body->addCssClass('mit-license');
$html->startBody();

use Sphp\Html\Foundation\Sites\Grids\DivGrid;

$licenseText = <<<MD
# MIT License

Copyright (c) 2011-2019 Sami Holck <sami.holc@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

MD
;
$main = Tags::main();
$main->appendSection()->appendMd($licenseText);
$main->append('<hr>');
$linkBar = new Foundation\Sites\Buttons\ButtonGroup();
$linkBar->setExtended(true);
$linkBar->appendPushButton('<i class="fas fa-arrow-left fa-lg"></i> Back')->setAttribute('onclick', 'window.history.back();');
$linkBar->appendHyperlink('/', Media\Icons\FontAwesome::i('fas fa-home')->setSize('lg') . ' Back to Manual');
$linkBar->appendHyperlink('https://github.com/samhol/SPHP-framework', Media\Icons\FontAwesome::i('fab fa-github')->setSize('lg') . ' repository');


$main->append($linkBar);
$grid = DivGrid::from([$main]);
echo $grid;

echo $html->getDocumentClose();
