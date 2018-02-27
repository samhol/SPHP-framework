<?php

namespace Sphp\Html;

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
$fa = FontAwesome::instance();
$grid = (new BlockGrid('small-up-1', 'medium-up-2', 'large-up-4'));
$grid->append((new Menu())->vertical()
                ->appendText('Who uses it?' . $fa->users()->pull('right'))
                ->appendLink('http://raisionveneseura.fi', 'Raisionveneseura.fi')
                ->appendLink('http://samiholck.com', '&lt;samiholck.com&gt;')
                ->appendLink('http://playground.samiholck.com/', 'SPHPlayground manual')
                ->appendText('Framework APIs' . $fa->book()->pull('right'))
                ->appendLink('http://playground.samiholck.com/API/sami/', $fa->php() . 'PHP API')
                ->appendLink('http://playground.samiholck.com/API/jsdoc/', $fa->js() . 'JavaScript API'));
$grid->append((new Menu())->vertical()
                ->appendText('JavaScript ' . $fa->js()->pull('right'))
                ->appendLink('https://www.w3.org/standards/webdesign/script.html', 'WEB APIS - <b>W3C</b>')
                ->appendLink('https://www.w3schools.com/js/', 'w3schools.com')
                ->appendRuler()
                ->appendLink('https://jquery.com/', DevIcons::jquery() . 'jQuery')
                ->appendLink('http://foundation.zurb.com/', DevIcons::foundationLogo() . 'Foundation')
                ->appendLink('http://qtip2.com/', 'qTip<sup>2</sup>')
                ->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT')
                ->appendLink('http://zeroclipboard.org/', 'ZeroClipboard', "_blank")
                ->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade;'));
$grid->append((new Menu())->vertical()
                ->appendText('PHP' . FontAwesome::php()->pull('right'))
                ->appendLink('http://php.net/manual/en/', 'PHP Manual')
                ->appendRuler()
                ->appendLink('https://phpunit.de/', 'PHPUnit')
                ->appendLink('https://framework.zend.com/', DevIcons::zend() . 'Zend')
                ->appendLink('https://github.com/erusev/parsedown-extra', DevIcons::symfony() . 'Symfony')
                ->appendLink('http://www.doctrine-project.org/', DevIcons::doctrine() . 'Doctrine')
                ->appendText('Databases' . FontAwesome::database()->pull('right'))
                ->appendLink('https://www.mysql.com/', DevIcons::mysql() . 'MySQL')
                ->appendLink('http://www.postgresql.org/', DevIcons::postgresql() . 'PostgreSQL')
                ->appendLink('https://sqlite.org/', 'SQLite'));
$grid->append((new Menu())->vertical()
                ->appendText('HTML ' . FontAwesome::html5()->pull('right'))
                ->appendLink('https://www.w3.org/html/', 'HTML5 - <b>W3C</b>')
                ->appendLink('https://www.w3schools.com/js/', 'w3schools.com')
                ->appendText('SASS' . FontAwesome::sass()->pull('right'))
                ->appendLink('http://sass-lang.com/', '<b>SASS</b> language')
                ->appendLink('http://sass-lang.com/guide', '<b>SASS</b> quide')
                ->appendText('CSS' . FontAwesome::css3()->pull('right'))
                ->appendLink('https://developer.mozilla.org/en-US/docs/Web/CSS', 'CSS - <b>MDN</b>')
                ->appendLink('https://www.w3.org/Style/CSS/Overview.en.html', 'CSS - <b>W3C</b>'));

$grid->printHtml();
