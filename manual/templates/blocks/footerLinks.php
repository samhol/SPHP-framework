<?php

namespace Sphp\Html;

use Sphp\Html\Icons\Icons;
use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$grid = (new BlockGrid('small-up-1', 'medium-up-2', 'large-up-4'));
$grid->append((new Menu())->vertical()
                ->appendText('Who uses it?' . Icons::fontAwesome('fa-users'))
                ->appendLink('http://raisionveneseura.fi', 'Raisionveneseura.fi')
                ->appendLink('http://samiholck.com', '&lt;samiholck.com&gt;')
                ->appendLink('http://playground.samiholck.com/', 'SPHPlayground manual')
                ->appendText('Framework APIs' . Icons::fontAwesome('fa-book'))
                ->appendLink('http://playground.samiholck.com/API/sami/', Icons::devicon('php-plain') . 'PHP API')
                ->appendLink('http://playground.samiholck.com/API/jsdoc/', Icons::devicon('javascript-plain') . 'JavaScript API'));
$grid->append((new Menu())->vertical()
                ->appendText('JavaScript ' . Icons::devicon('javascript-plain'))
                ->appendLink('https://www.w3.org/standards/webdesign/script.html', 'WEB APIS - <b>W3C</b>')
                ->appendLink('https://www.w3schools.com/js/', 'w3schools.com')
                ->appendRuler()
                ->appendLink('https://jquery.com/', Icons::devicon('jquery-plain') . 'jQuery')
                ->appendLink('http://foundation.zurb.com/', Icons::devicon('foundation-plain') . 'Foundation')
                ->appendLink('http://qtip2.com/', 'qTip<sup>2</sup>')
                ->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT')
                ->appendLink('http://zeroclipboard.org/', 'ZeroClipboard', "_blank")
                ->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade;'));
$grid->append((new Menu())->vertical()
                ->appendText('PHP' . Icons::devicon('php-plain'))
                ->appendLink('http://php.net/manual/en/', 'PHP Manual')
                ->appendRuler()
                ->appendLink('https://phpunit.de/', 'PHPUnit')
                ->appendLink('https://framework.zend.com/', Icons::devicon('zend-plain') . 'Zend')
                ->appendLink('https://github.com/erusev/parsedown-extra', Icons::devicon('symfony-original') . 'Symfony')
                ->appendLink('http://www.doctrine-project.org/', Icons::devicon('doctrine-plain') . 'Doctrine')
                ->appendText('Databases' . Icons::fontAwesome('fa-database'))
                ->appendLink('https://www.mysql.com/', Icons::devicon('mysql-plain') . 'MySQL')
                ->appendLink('http://www.postgresql.org/', Icons::devicon('postgresql-plain') . 'PostgreSQL')
                ->appendLink('https://sqlite.org/', 'SQLite'));
$grid->append((new Menu())->vertical()
                ->appendText('HTML ' . Icons::devicon('html5-plain'))
                ->appendLink('https://www.w3.org/html/', 'HTML5 - <b>W3C</b>')
                ->appendLink('https://www.w3schools.com/js/', 'w3schools.com')
                ->appendText('SASS' . Icons::devicon('sass-original'))
                ->appendLink('http://sass-lang.com/', '<b>SASS</b> language')
                ->appendLink('http://sass-lang.com/guide', '<b>SASS</b> quide')
                ->appendText('CSS' . Icons::devicon('css3-plain'))
                ->appendLink('https://developer.mozilla.org/en-US/docs/Web/CSS', 'CSS - <b>MDN</b>')
                ->appendLink('https://www.w3.org/Style/CSS/Overview.en.html', 'CSS - <b>W3C</b>'));

$grid->printHtml();
