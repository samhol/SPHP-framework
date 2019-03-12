<?php

use Sphp\Html\Media\Icons\SvgLoader;

$root = '/home/int48291/public_html/playground/manual/svg';
$deviconPath = "$root/devicons";

?>
<div class="grid-x sphp-slick-container"> 
  <div class="cell auto">
    <div class="sphp-tech-slick" id="skill-icons">

      <div class="sphp-info-button" data-tech="sphp-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$root/s-logo.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="html5-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/html5/html5-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="css-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/css3/css3-original.svg") ?>
        </div>
         </div>
      <div class="sphp-info-button" data-tech="sass-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/sass/sass-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="js-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/javascript/javascript-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="nodejs-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/nodejs/nodejs-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="gulp-info">
        <div class="svg-container">
          <?php echo SvgLoader::fromUrl("$deviconPath/gulp/gulp-plain.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="foundation-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/foundation/foundation-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="php-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/php/php-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="symfony-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/symfony/symfony-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="zend-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/zend/zend-plain.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="doctrine-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/doctrine/doctrine-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="mysql-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/mysql/mysql-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="postgresql-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$deviconPath/postgresql/postgresql-original.svg") ?>
        </div>
      </div>

      <div class="sphp-info-button" data-tech="sqlite-info">
        <div class="svg-container">
          <?php echo SvgLoader::fileToObject("$root/sqlite-logo.svg") ?>
        </div>
      </div>

    </div>
  </div>
</div>


<div class="info-carousel" id="skill-info">
  <?php 

use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Parsers\Parser;
error_reporting(E_ALL);
ini_set("display_errors", "1");
//require_once '../../../settings.php';
$str = Filesystem::executePhpToString('manual/snippets/carousels/content/skills-md.php');
echo Parser::fromString($str, 'md'); ?>
</div>
