<?php

namespace Sphp\Html;

require_once('manual/settings.php');

$html = Document::html();


Document::html()->setLanguage('en');

use Sphp\Html\Head\Link;
use Sphp\Html\Head\Meta;

Document::head()
        //->enableSPHP()
        ->setBaseAddr('http://playground.samiholck.com/')
        ->setDocumentTitle('License | SPHPlayground framework')
        ->addShortcutIcon('manual/pics/S-logo.png')
        ->set(Link::stylesheet('manual/css/license/license.css'))
        ->set(Link::create('http://playground.samiholck.com/manual/pics/apple-touch-icon.png', 'apple-touch-icon'))
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('SPHPlayground framework'))
        ->addMeta(Meta::keywords([
                    'GNU',
                    'license',
                    'SPHPlayground']))
        ->addMeta(Meta::description('License for SPHPlayground framework'));
Document::body()->addCssClass('gnu-license');
Document::html()->startBody();

use Sphp\Html\Foundation\Sites\Grids\Grid;
use Sphp\Stdlib\Parser;

$grid = Grid::from([
            Parser::fromString(<<<MD
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
                    , 'md')]);
echo $grid->addCssClass('gnu-license');

echo $html->getDocumentClose();
