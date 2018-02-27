<?php

namespace Sphp\Html;

require_once('manual/settings.php');

$html = Document::html();


Document::html()->setLanguage('en');

use Sphp\Html\Head\Meta;

Document::head()
        //->enableSPHP()
        ->setBaseAddr('http://playground.samiholck.com/')
        ->setDocumentTitle('License | SPHPlayground framework')
        ->addShortcutIcon('manual/pics/S-logo.png')
        ->add(Head\Link::stylesheet('manual/css/license/license.css'))
        ->add(Head\Link::create('http://playground.samiholck.com/manual/pics/apple-touch-icon.png', 'apple-touch-icon'))
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

$grid = Grid::from([Parser::fromFile('LICENSE.md')]);
echo $grid->addCssClass('gnu-license');

echo $html->getDocumentClose();
