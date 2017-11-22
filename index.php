<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');
//ob_implicit_flush(true);
$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);

$cacheSuffix = str_replace(['.', '/'], ['-', ''], $redirect)."-cache";

if ($outputCache->start("$cacheSuffix-head") === false) {
  require_once('manual/templates/blocks/head.php');
  $outputCache->end();
}
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
    if ($outputCache->start("$cacheSuffix-topbar") === false) {
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
          $man_cache = "$cacheSuffix-content";
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
if ($outputCache->start('footer') === false) {
  include('manual/templates/blocks/footer.php');
  include('manual/templates/backToTopButton.php');
  $outputCache->end();
}

$html->documentClose();
