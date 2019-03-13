<?php

//include 'manual/snippets/carousels/skills.php';

use Sphp\Html\Apps\Slick\Carousel;


$root = '/home/int48291/public_html/playground//manual/svg';
$deviconPath = "$root/devicons";
$carousel = new Carousel();
$carousel->setAttribute('id', 'tech-icons');
use Sphp\Html\Media\Icons\SvgLoader;
//$carousel->addCssClass('logos');
$carousel->appendHtml('<div>'.SvgLoader::fileToObject("$root/s-logo.svg", 'SPHP')->setWidth(300).'</div>');
$carousel->appendFigure("$deviconPath/html5/html5-original.svg", 'SPHP');
$carousel->appendFigure("$deviconPath/css3/css3-original.svg");
$carousel->appendFigure("$deviconPath/sass/sass-original.svg");
$carousel->appendFigure("$deviconPath/javascript/javascript-original.svg");
$carousel->appendFigure("$deviconPath/nodejs/nodejs-original.svg");
/*$carousel->appendFigure("$deviconPath/npm/npm-original-wordmark.svg");
$carousel->appendFigure("$deviconPath/gulp/gulp-plain.svg");
$carousel->appendFigure("$deviconPath/foundation/foundation-original.svg");
$carousel->appendFigure("$deviconPath/php/php-original.svg");
$carousel->appendFigure("$deviconPath/symfony/symfony-original.svg");
$carousel->appendFigure("$deviconPath/zend/zend-plain.svg");
$carousel->appendFigure("$deviconPath/doctrine/doctrine-original.svg");
$carousel->appendFigure("$deviconPath/mysql/mysql-original.svg");
$carousel->appendFigure("$deviconPath/postgresql/postgresql-original.svg");
$carousel->appendFigure("$root/sqlite-logo.svg");*/

echo $carousel;

$mdPath = 'manual/snippets/carousels/content/techs';
$descriptions = new Carousel();
$descriptions->setAttribute('id', 'tech-info');
$descriptions->appendMdFile("$mdPath/sphp.md");
$descriptions->appendMdFile("$mdPath/html5.md");
$descriptions->appendMdFile("$mdPath/css.md");
$descriptions->appendMdFile("$mdPath/sass.md");
$descriptions->appendMdFile("$mdPath/js.md");
$descriptions->appendMdFile("$mdPath/nodejs.md");

echo $descriptions;

















