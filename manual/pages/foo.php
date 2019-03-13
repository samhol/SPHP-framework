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

echo $carousel;

$mdPath = 'manual/snippets/carousels/content/techs';
$descriptions = new Carousel();
$descriptions->setAttribute('id', 'tech-info');
$descriptions->appendMdFile("$mdPath/sphp.md");
$descriptions->appendMdFile("$mdPath/html5.md");
$descriptions->appendMdFile("$mdPath/css.md");
$descriptions->appendMdFile("$mdPath/sass.md");
$descriptions->appendMdFile("$mdPath/js.md");
$descriptions->appendMdFile("$mdPath/foundation.md");
$descriptions->appendMdFile("$mdPath/nodejs.md");
$descriptions->appendMdFile("$mdPath/npm.md");
$descriptions->appendMdFile("$mdPath/gulp.md");
$descriptions->appendMdFile("$mdPath/php.md");
$descriptions->appendMdFile("$mdPath/zend.md");
$descriptions->appendMdFile("$mdPath/symfony.md");
$descriptions->appendMdFile("$mdPath/doctrine.md");
$descriptions->appendMdFile("$mdPath/mysql.md");
$descriptions->appendMdFile("$mdPath/postgresql.md");
$descriptions->appendMdFile("$mdPath/sqlite.md");

echo $descriptions;









































