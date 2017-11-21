<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');
ob_implicit_flush(true);
require_once('manual/templates/blocks/head.php');

$cache = new \Zend\Cache\Storage\Adapter\Filesystem();

$cache->setOptions([
    'ttl' => 1,
    'cache_dir' => 'cache',
    'dir_permission' => 0755,
    'file_permission' => 0666]);

use Zend\Cache\PatternFactory;

$plugin = new \Zend\Cache\Storage\Plugin\ExceptionHandler(array(
    'throw_exceptions' => false,
        ));
$cache->addPlugin($plugin);
$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);
?>
<div class="off-canvas-wrapper">
  <div class="off-canvas-absolute position-left" id="bodyOffCanvas" data-off-canvas>
    <!-- Your menu or Off-canvas content goes here -->
  </div>
  <div class="off-canvas-absolute position-right" id="rightBodyOffCanvas" data-off-canvas>
    <!-- Your menu or Off-canvas content goes here -->
  </div>
  <div class="off-canvas-content" data-off-canvas-content>
    <?php
    if ($outputCache->start('topbar1212') === false) {
      include('manual/templates/logo-area.php');
      include('manual/templates/menus/topBar.php');
      $outputCache->end();
    }
    ?>
    <div class="row expanded small-collapse medium-uncollapse">
      <div class="column medium-3 large-3 xlarge-2 show-for-large">
        <?php
        if ($outputCache->start('sidenav') === false) {
          include('manual/templates/menus/sidenav.php');
          $outputCache->end();
        }
        ?>
      </div>
      <div class="mainContent  small-12 large-9 xlarge-9 column"> 
        <div class="container">
          <?php
          $p = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
          $man_cache = 'index';
          if ($p !== null) {
            $man_cache = str_replace('.', '-', $p);
          }
          if ($outputCache->start($man_cache) === false) {
            //include('manual/manualBuilder.php');        
            $router->execute();
            $outputCache->end();
          }
          ?>
        </div>
      </div>
      <div class="show-for-xlarge xlarge-1 column"> 
      </div>
    </div>
  </div>
</div>
<?php
include('manual/templates/blocks/footer.php');
include('manual/templates/backToTopButton.php');

$html->documentClose();
