<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');
  use Sphp\Network\Cookie;
$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);

$cacheSuffix = str_replace(['.', '/', ':'], ['-', '', ''], $redirect) . "-cache";

if ($outputCache->start("$cacheSuffix-page") === false) {

    $cookie = (new Cookie("comply_cookie"))->delete();
  require_once('manual/templates/blocks/head.php');
  require_once('manual/templates/logo-area.php');
  require_once('manual/templates/menus/topBar.php');
  echo '<div class="grid-container"><div class="grid-x"><div class="cell shrink show-for-large">';
  include('manual/templates/menus/sidenav.php');
  echo '</div><div class="cell auto">';
  $router->execute(\Sphp\Network\URL::getCurrentURL());
  echo '</div></div></div>';
  include('manual/templates/footer/footer.php');
  include('manual/templates/backToTopButton.php');
  $outputCache->end();
}

$html->documentClose();
