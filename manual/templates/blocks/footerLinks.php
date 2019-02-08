<?php

namespace Sphp\Html;

use Sphp\Html\Media\Icons\FA;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Foundation\Sites\Navigation\Menu;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$faRight = (new FA())->pull('right')->fixedWidth(true);
$faLeft = (new FA())->pull('left')->fixedWidth(true);

$grid = (new BlockGrid('small-up-1', 'medium-up-2', 'large-up-4'));

$firstMenu = (new Menu())->vertical();
$firstMenu->appendText('Who uses it?' . $faRight->users());
$firstMenu->appendLink('http://raisionveneseura.fi', 'Raisionveneseura.fi');
$firstMenu->appendLink('http://samiholck.com', '&lt;samiholck.com&gt;');
$firstMenu->appendLink('http://playground.samiholck.com/', 'SPHPlayground manual');
$firstMenu->appendText('Framework APIs' . $faRight->book());
$firstMenu->appendLink('http://playground.samiholck.com/API/sami/', $faLeft->php() . 'PHP API');
$firstMenu->appendLink('http://playground.samiholck.com/API/jsdoc/', $faLeft->js() . 'JavaScript API');
$firstMenu->appendText('Unit Testing' . $faRight->stethoscope());
$firstMenu->appendLink('https://travis-ci.org/samhol/SPHP-framework', DevIcons::travis() . 'Travis CL');
$firstMenu->appendLink('https://mochajs.org/', DevIcons::mocha() . 'Mocha');

$grid->append($firstMenu);

$secondMenu = (new Menu())->vertical();
$secondMenu->appendText('JavaScript ' . $faRight->js());
$secondMenu->appendLink('https://nodejs.org/', 'Node.js' . $faLeft->nodejs());
$secondMenu->appendLink('https://gulpjs.com/', 'gulp.js' . $faLeft->gulp());
$secondMenu->appendRuler();
$secondMenu->appendLink('https://jquery.com/', DevIcons::jquery() . 'jQuery');
$secondMenu->appendLink('http://foundation.zurb.com/', DevIcons::foundationLogo() . 'Foundation');
$secondMenu->appendLink('http://qtip2.com/', 'qTip<sup>2</sup>');
$secondMenu->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT');
$secondMenu->appendLink('http://zeroclipboard.org/', 'ZeroClipboard');
$secondMenu->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade;');

$grid->append($secondMenu);

$thirdMenu = (new Menu())->vertical();
$thirdMenu->appendText('PHP' . $faRight->php());
$thirdMenu->appendLink('http://php.net/manual/en/', 'PHP Manual' . $faRight->php());
$thirdMenu->appendRuler();
$thirdMenu->appendLink('https://phpunit.de/', 'PHPUnit');
$thirdMenu->appendLink('https://framework.zend.com/', DevIcons::zend() . 'Zend');
$thirdMenu->appendLink('https://github.com/erusev/parsedown-extra', DevIcons::symfony() . 'Symfony');
$thirdMenu->appendLink('http://www.doctrine-project.org/', DevIcons::doctrine() . 'Doctrine');
$thirdMenu->appendText('Databases' . $faRight->database());
$thirdMenu->appendLink('https://www.mysql.com/', DevIcons::mysql() . 'MySQL');
$thirdMenu->appendLink('http://www.postgresql.org/', DevIcons::postgresql() . 'PostgreSQL');
$thirdMenu->appendLink('https://sqlite.org/', 'SQLite');

$grid->append($thirdMenu);

$fourthMenu = (new Menu())->vertical();
$fourthMenu->appendText('HTML ' . $faRight->html5());
$fourthMenu->appendLink('https://www.w3.org/html/', 'HTML5 - <b>W3C</b>');
$fourthMenu->appendLink('https://www.w3schools.com/js/', 'w3schools.com');
$fourthMenu->appendText('SASS' . $faRight->sass());
$fourthMenu->appendLink('http://sass-lang.com/', '<b>SASS</b> language');
$fourthMenu->appendLink('http://sass-lang.com/guide', '<b>SASS</b> quide');
$fourthMenu->appendText('CSS' . $faRight->css3());
$fourthMenu->appendLink('https://developer.mozilla.org/en-US/docs/Web/CSS', 'CSS - <b>MDN</b>');
$fourthMenu->appendLink('https://www.w3.org/Style/CSS/Overview.en.html', 'CSS - <b>W3C</b>');

$grid->append($fourthMenu);

$grid->printHtml();
