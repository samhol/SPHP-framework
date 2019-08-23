<?php

use Sphp\Html\Apps\Slick\Carousel;

$root = '/home/int48291/public_html/playground//manual/svg';
$deviconPath = "$root/devicons";
$carousel = new Carousel();
$carousel->addCssClass('tech-icon-carousel');
$carousel->setAttribute('id', 'tech-icons');

use Sphp\Html\Media\Image\SvgLoader;

$loader = SvgLoader::instance();
//$carousel->addCssClass('logos');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$root/s-logo.svg") . '</div>')->addCssClass('svg-container');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/html5/html5-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/css3/css3-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/sass/sass-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/javascript/javascript-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/foundation/foundation-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/nodejs/nodejs-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/npm/npm-original-wordmark.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/gulp/gulp-plain.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/php/php-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/zend/zend-plain.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/symfony/symfony-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/doctrine/doctrine-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/mysql/mysql-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$deviconPath/postgresql/postgresql-original.svg") . '</div>');
$carousel->appendHtml('<div class="svg">' . $loader->fileToObject("$root/sqlite-logo.svg") . '</div>');


$mdPath = 'manual/snippets/carousels/content/techs';
$descriptions = new Carousel();
$descriptions->setAttribute('id', 'tech-info');
$descriptions->addCssClass('tech-descriptions');
$descriptions->appendMdFile("$mdPath/sphp.md")->addCssClass('sphp');
$descriptions->appendMdFile("$mdPath/html5.md")->addCssClass('html5');
$descriptions->appendMdFile("$mdPath/css.md")->addCssClass('css');
$descriptions->appendMdFile("$mdPath/sass.php")->addCssClass('sass');
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

echo '<div class="grid-x sphp tech-carousel-container"><div class="cell auto">' . $carousel . $descriptions . '</div></div>';


















































