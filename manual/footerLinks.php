<?php

namespace Sphp\Html\Foundation;

use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Document;

$links['js'] = (new Menu())->vertical()
        ->appendText('JavaScript ' . Document::icon('fa fa-code'))
        ->appendLink('https://jquery.com/', "jQuery", '_blank')
        ->appendLink('http://foundation.zurb.com/', "Foundation", '_blank')
        ->appendLink('http://qtip2.com/', 'qTip<sup>2</sup>', '_blank')
        ->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT', '_blank')
        ->appendLink('http://zeroclipboard.org/', "ZeroClipboard", "_blank")
        ->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade;', '_blank');
$links['php'] = (new Menu())->vertical()
        ->appendText("PHP" . Document::icon('fa fa-code'))
        ->appendLink('https://github.com/erusev/parsedown-extra', 'Parsedown Extra', '_blank')
        ->appendLink('http://qbnz.com/highlighter/', 'GeSHi', '_blank')
        ->appendLink('https://imagine.readthedocs.org', 'Imagine', '_blank')
        ->appendText('SQL' . Document::icon('fa fa-database'))
        ->appendLink('https://www.mysql.com/', 'MySQL', '_blank')
        ->appendLink('http://www.postgresql.org/', 'Postgre SQL', '_blank');
$links['sass'] = (new Menu())->vertical()
        ->appendText('SASS')
        ->appendLink('http://sass-lang.com/', 'SASS language', '_blank')
        ->appendLink('http://thesassway.com/', 'The Sass Way', '_blank')
        ->appendLink('http://compass-style.org/', 'Compass framework', '_blank')
        ->appendLink('http://foundation.zurb.com/sites/docs/sass.html', 'Foundation SASS', '_blank');
$links['tutorials'] = (new Menu())->vertical()
        ->appendText('Misc. Tutorials' . Document::icon('fa fa-book'))
        ->appendLink('https://developer.mozilla.org/', '<b>MDN</b>', '_blank')
        ->appendLink('http://stackoverflow.com/', 'stack <b>Overflow</b>', '_blank')
        ->appendText('w3cschools.com')
        ->appendLink('http://www.w3schools.com/html/', 'HTML tutorial', '_blank')
        ->appendLink('http://www.w3schools.com/CSS/', 'CSS tutorial', '_blank')
        ->appendLink('http://www.w3schools.com/jquery/', 'jQuery tutorial', '_blank')
        ->appendLink('http://www.w3schools.com/sql/', 'SQL tutorial', '_blank');

$grid = (new BlockGrid($links, 2, 2, 4))->addCssClass('collapse');
$grid->printHtml();
