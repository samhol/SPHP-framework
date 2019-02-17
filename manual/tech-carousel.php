<?php
use Sphp\Html\Media\Icons\SvgLoader;
?>

<div class="grid-x sphp-slick-container">
  <div class="cell auto">
    <div class="sphp-tech-slick">

      <div class="sphp-info-button sphp" data-tech="sphp-info">
        <?php echo SvgLoader::fileToString('manual/svg/s-logo.svg') ?>
      </div>

      <div class="sphp-info-button html5" data-tech="html5-info">
        <?php echo SvgLoader::fileToString('manual/svg/html5-logo.svg') ?>
      </div>

      <div class="sphp-info-button css3" data-tech="css-info">
        <?php echo SvgLoader::fileToString('manual/svg/css3-logo.svg') ?>
      </div>

      <div class="sphp-info-button sass" data-tech="sass-info">
        <?php echo SvgLoader::fileToString('manual/svg/sass-logo.svg') ?>
      </div>

      <div class="sphp-info-button js" data-tech="js-info">
        <?php echo SvgLoader::fileToString('manual/svg/js-logo.svg') ?>
      </div>
      
      <div class="sphp-info-button" data-tech="nodejs-info">
        <?php echo SvgLoader::fileToString('manual/svg/nodejs-logo.svg') ?>
      </div>
      
      <div class="sphp-info-button" data-tech="gulp-info">
        <?php echo SvgLoader::fileToString('manual/svg/gulp-logo.svg') ?>
      </div>

      <div class="sphp-info-button foundation" data-tech="foundation-info">
        <?php echo SvgLoader::fileToString('manual/svg/foundation-logo.svg') ?>
      </div>

      <div class="sphp-info-button php" data-tech="php-info">
        
        <?php echo SvgLoader::fileToString('manual/svg/devicons/php/php-original.svg') ?>
      </div>

      <div class="sphp-info-button symfony" data-tech="symfony-info">
        <?php echo SvgLoader::fileToString('manual/svg/symfony.svg') ?>
      </div>

      <div class="sphp-info-button zend" data-tech="zend-info">
        <?php echo SvgLoader::fileToString('manual/svg/zend-logo.svg') ?>
      </div>

      <div class="sphp-info-button doctrine" data-tech="doctrine-info">
        <?php echo SvgLoader::fileToString('manual/svg/doctrine-logo.svg') ?>
      </div>

      <div class="sphp-info-button mysql" data-tech="mysql-info">
        <?php echo SvgLoader::fileToString('manual/svg/mysql-logo.svg') ?>
      </div>

      <div class="sphp-info-button postgresql" data-tech="postgresql-info">
        <?php echo SvgLoader::fileToString('manual/svg/postgresql.svg') ?>
      </div>

    </div>
  </div>
</div>

<div class="package-def" id="ooo" data-sphp-ajax-append="manual/snippets/techs.php #sphp-info"></div>
