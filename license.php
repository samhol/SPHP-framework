<?php

namespace Sphp\Html;

require_once('manual/settings.php');

use Sphp\Html\Head\Link;
use Sphp\Html\Head\Meta;

$html = Document::html();
$head = Document::head();
$body = Document::body();

$html->setLanguage('en');

$head->set(Meta::charset('UTF-8'));
$head->set(Meta::viewport('width=device-width, initial-scale=1.0'));
$head->setDocumentTitle('License | SPHPlayground framework');
$head->setBaseAddr('http://playground.samiholck.com/', '_self');

$head->set(Link::stylesheet('http://playground.samiholck.com/manual/css/license/license.css'));
//$head->setCssSrc('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css');

$head->set(Link::appleTouchIcon('/apple-touch-icon.png'));
$head->set(Link::icon('/favicon-32x32.png', '32x32'));
$head->set(Link::icon('/favicon-16x16.png', '16x16'));
$head->set(Link::manifest('/site.webmanifest'));
$head->set(Link::maskIcon('/safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));

$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['MIT', 'license', 'SPHPlayground']));
$head->set(Meta::description('License for SPHPlayground framework'));

$html->useFontAwesome();
Document::body()->addCssClass('mit-license');
Document::html()->startBody();

use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Stdlib\Parsers\Parser;

$grid = DivGrid::from([
            Parser::md()->parseString(<<<MD
#MIT License

Copyright (c) 2018 Sami Holck

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
)]);
echo $grid;

echo $html->getDocumentClose();
