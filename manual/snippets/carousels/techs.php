<?php

use Sphp\Html\Apps\Slick\Carousel;

$root = '/home/int48291/public_html/playground//manual/svg';
$deviconPath = "$root/devicons";
$carousel = new Carousel();
$carousel->addCssClass('sphp-tech-slick');
$carousel->setAttribute('id', 'tech-icons');

use Sphp\Html\Media\Icons\SvgLoader;

//$carousel->addCssClass('logos');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$root/s-logo.svg") . '</div>')->addCssClass('svg-container');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/html5/html5-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/css3/css3-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/sass/sass-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/javascript/javascript-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/foundation/foundation-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/nodejs/nodejs-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/npm/npm-original-wordmark.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/gulp/gulp-plain.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/php/php-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/symfony/symfony-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/zend/zend-plain.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/doctrine/doctrine-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/mysql/mysql-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$deviconPath/postgresql/postgresql-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . SvgLoader::fileToObject("$root/sqlite-logo.svg") . '</div>');


$mdPath = 'manual/snippets/carousels/content/techs';
$descriptions = new Carousel();
$descriptions->setAttribute('id', 'tech-info');
$descriptions->appendMdFile("$mdPath/sphp.md")->addCssClass('sphp');
$descriptions->appendMdFile("$mdPath/html5.md")->addCssClass('html5');
$descriptions->appendMdFile("$mdPath/css.md")->addCssClass('css');
$descriptions->appendMdFile("$mdPath/sass.md")->addCssClass('sass');
$descriptions->appendMdFile("$mdPath/js.md")->addCssClass('js');
$descriptions->appendMdFile("$mdPath/foundation.md")->addCssClass('foundation');
$descriptions->appendMdFile("$mdPath/nodejs.md")->addCssClass('nodejs');
$descriptions->appendMdFile("$mdPath/npm.md")->addCssClass('npm');
$descriptions->appendMdFile("$mdPath/gulp.md")->addCssClass('gulp');
$descriptions->appendMdFile("$mdPath/php.md")->addCssClass('php');
$descriptions->appendMdFile("$mdPath/zend.md")->addCssClass('zend');
$descriptions->appendMdFile("$mdPath/symfony.md")->addCssClass('symfony');
$descriptions->appendMdFile("$mdPath/doctrine.md")->addCssClass('doctrine');
$descriptions->appendMdFile("$mdPath/mysql.md")->addCssClass('mysql');
$descriptions->appendMdFile("$mdPath/postgresql.md")->addCssClass('postgresql');
$descriptions->appendMdFile("$mdPath/sqlite.md")->addCssClass('sqlite');

echo '<div class="grid-x sphp-slick-container"><div class="cell auto">' . $carousel . $descriptions . '</div></div>';












































