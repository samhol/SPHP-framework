<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);

$cacheSuffix = str_replace(['.', '/'], ['-', ''], $redirect) . "-cache";

if ($outputCache->start("$cacheSuffix-head") === false) {
  require_once('manual/templates/blocks/head.php');
  $outputCache->end();
}
?>

<?php
if ($outputCache->start("$cacheSuffix-topbar") === false) {
  include('manual/templates/logo-area.php');
  include('manual/templates/menus/topBar.php');
  $outputCache->end();
}
?>
<div class="grid-container full">
  <div class="grid-x">
    <div class="cell small-12 large-3 xlarge-3 show-for-large">
      <?php
      if ($outputCache->start('sidenav') === false) {
        include('manual/templates/menus/sidenav.php');
        $outputCache->end();
      }
      ?>
    </div>
    <div class="small-auto large-9 xlarge-9 cell"> 
      <div class="mainContent">
        <div class="container">
          <?php
          $man_cache = "$cacheSuffix-content";
          if ($outputCache->start($man_cache) === false) {
            $router->execute();
            $outputCache->end();
          }
          ?>
        </div>
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

