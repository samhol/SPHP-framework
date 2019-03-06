<?php

namespace Sphp\Html;

use Sphp\Html\Media\Icons\FA;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;



$faRight = (new FA())->pull('right')->fixedWidth(true);
$faLeft = (new FA())->pull('left')->fixedWidth(true);
$data['usage']['title'] = 'Who uses SPHPlayground?' . $faRight->users();
$data['usage'][] = ['http://raisionveneseura.fi', 'Raisionveneseura.fi'];
$data['usage'][] = ['http://samiholck.com', '&lt;samiholck.com&gt;'];
$data['usage'][] = ['http://playground.samiholck.com/', 'SPHPlayground manual'];
$m1Sub2 = $firstMenua->appendSubMenu();
$data['sphp-api']['title'] = 'Framework APIs' . $faRight->book();
$m1Sub2->appendLink('http://playground.samiholck.com/API/sami/', $faLeft->php() . 'PHP API');
$m1Sub2->appendLink('http://playground.samiholck.com/API/jsdoc/', $faLeft->js() . 'JavaScript API');
$m1Sub3 = $firstMenua->appendSubMenu();
$m1Sub3->setRoot('Unit Testing' . $faRight->stethoscope());
$m1Sub3->appendLink('https://travis-ci.org/samhol/SPHP-framework', DevIcons::travis() . 'Travis CL');
$m1Sub3->appendLink('https://mochajs.org/', DevIcons::mocha() . 'Mocha');

$firstMenu = (new FlexibleMenu())->addCssClass('show-for-medium')->setVertical();
$firstMenu->appendText('Who uses SPHPlayground?' . $faRight->users());
$firstMenu->appendLink('http://raisionveneseura.fi', 'Raisionveneseura.fi');
$firstMenu->appendLink('http://samiholck.com', '&lt;samiholck.com&gt;');
$firstMenu->appendLink('http://playground.samiholck.com/', 'SPHPlayground manual');
$firstMenu->appendText('Framework APIs' . $faRight->book());
$firstMenu->appendLink('http://playground.samiholck.com/API/sami/', $faLeft->php() . 'PHP API');
$firstMenu->appendLink('http://playground.samiholck.com/API/jsdoc/', $faLeft->js() . 'JavaScript API');
$firstMenu->appendText('Unit Testing' . $faRight->stethoscope());
$firstMenu->appendLink('https://travis-ci.org/samhol/SPHP-framework', DevIcons::travis() . 'Travis CL');
$firstMenu->appendLink('https://mochajs.org/', DevIcons::mocha() . 'Mocha');

$grid->append($firstMenua.$firstMenu);

$secondMenu = (new FlexibleMenu())->setVertical();
$secondMenu->appendText('JavaScript ' . $faRight->js());
$secondMenu->appendLink('https://nodejs.org/', 'Node.js' . $faLeft->nodejs());
$secondMenu->appendLink('https://www.npmjs.com/', 'npm' . $faLeft->npm());
$secondMenu->appendLink('https://gulpjs.com/', 'gulp.js' . $faLeft->gulp());
$secondMenu->appendRuler();
$secondMenu->appendLink('https://jquery.com/', DevIcons::jquery() . 'jQuery');
$secondMenu->appendLink('http://foundation.zurb.com/', DevIcons::foundationLogo() . 'Foundation');
$secondMenu->appendLink('http://qtip2.com/', 'qTip<sup>2</sup>');
$secondMenu->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT');
$secondMenu->appendLink('http://zeroclipboard.org/', 'ZeroClipboard');
$secondMenu->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade;');

$grid->append($secondMenu);

$thirdMenu = (new FlexibleMenu())->setVertical();
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

$fourthMenu = (new FlexibleMenu())->setVertical();
$fourthMenu->appendText('HTML ' . $faRight->html5());
$fourthMenu->appendLink('https://www.w3.org/html/', 'HTML5 - <b>W3C</b>');
$fourthMenu->appendLink('https://www.w3schools.com/js/', 'w3schools.com');
$fourthMenu->appendText('SASS' . $faRight->sass());
$fourthMenu->appendLink('http://sass-lang.com/', '<b>SASS</b> language');
$fourthMenu->appendLink('http://compass-style.org/', '<b style="color:#fb292d;">Compass</b> framework' . $faRight->compass());
$fourthMenu->appendText('CSS' . $faRight->css3());
$fourthMenu->appendLink('https://developer.mozilla.org/en-US/docs/Web/CSS', 'CSS - <b>MDN</b>');
$fourthMenu->appendLink('https://css-tricks.com/', 'CSS-TRICKS' . $faLeft->asterisk());

$grid->append($fourthMenu);

$grid->printHtml();
