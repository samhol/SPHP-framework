<?php

//include 'manual/snippets/carousels/skills.php';

use Sphp\Html\Apps\Slick\Carousel;

$settings = [
   // 'adaptiveHeight' => true,
    'dots' => true,
    'infinite' => true,
    'speed' => 3000,
    'slidesToShow' => 3,
    'slidesToScroll' => 1,
    //'autoplay' => true,
    //'autoplaySpeed' => 2000,
    'centerMode' => true,
    'focusOnSelect' => true,
    //'variableWidth' => true,
    
];
$root = '/manual/svg';
$deviconPath = "$root/devicons";
$carousel = new Carousel($settings);
$carousel->addCssClass('logos');
$carousel->appendFigure("$root/s-logo.svg", 'SPHP');
$carousel->appendFigure("$deviconPath/html5/html5-original.svg");
$carousel->appendFigure("$deviconPath/css3/css3-original.svg");
$carousel->appendFigure("$deviconPath/sass/sass-original.svg");
$carousel->appendFigure("$deviconPath/javascript/javascript-original.svg");
$carousel->appendFigure("$deviconPath/nodejs/nodejs-original.svg");
$carousel->appendFigure("$deviconPath/npm/npm-original-wordmark.svg");
$carousel->appendFigure("$deviconPath/gulp/gulp-plain.svg");
$carousel->appendFigure("$deviconPath/foundation/foundation-original.svg");
$carousel->appendFigure("$deviconPath/php/php-original.svg");
$carousel->appendFigure("$deviconPath/symfony/symfony-original.svg");
$carousel->appendFigure("$deviconPath/zend/zend-plain.svg");
$carousel->appendFigure("$deviconPath/doctrine/doctrine-original.svg");
$carousel->appendFigure("$deviconPath/mysql/mysql-original.svg");
$carousel->appendFigure("$deviconPath/postgresql/postgresql-original.svg");
$carousel->appendFigure("$root/sqlite-logo.svg");

echo $carousel;


