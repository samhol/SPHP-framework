<?php

//namespace Sphp\Html\Foundation\Sites\Navigation;

require_once('manual/settings.php');

use Sphp\Network\Cookies\Cookie;

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);

$cacheSuffix = str_replace(['.', '/', ':'], ['-', '', ''], $redirect) . "-cache";

if ($outputCache->start("$cacheSuffix-page") === false) {

  //$cookie = (new Cookie('comply_cookie'))->delete();
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

  $cookieBanner = new Sphp\Html\Apps\CookieBanner();
  $cookieBanner->setAcceptButton('<i class="far fa-check-circle fa-"></i> Accept cookies')->addCssClass('radius');
  $cookieBanner->contentContainer()->appendMd('**SPHPlayground** uses cookies. By continuing we assume your 
      permission to deploy cookies, as detailed in our  [privacy policy](/manual/privacy_policy.php).');
  echo $cookieBanner;
  $outputCache->end();
}

use Sphp\Stdlib\StopWatch;

$mem = number_format(memory_get_usage(true) / 1048576, 2);
$time = number_format(StopWatch::getExecutionTime(), 2);
$phpScript = new \Sphp\Html\Scripts\ScriptCode();
$phpScript[] = "var php={version: '" . phpversion() . "'};";
$phpScript[] = "php.memory=" . $mem . ";";
$phpScript[] = "php.execTime=" . $time . ";";

use Sphp\Exceptions\RuntimeException;

if ($html instanceof \Sphp\Html\Html) {
  $html->body()->scripts()->append($phpScript);
  $html->documentClose();
} else {
  throw new RuntimeException('Document is undefined');
}
