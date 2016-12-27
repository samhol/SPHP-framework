<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Document;

include_once('manual/settings.php');
include_once('manual/links.php');
include_once(\Sphp\PDO_SESSIONING);
ob_implicit_flush(true);
include_once('manual/htmlHead.php');

$cache = new \Zend\Cache\Storage\Adapter\Filesystem();

$cache->setOptions([
    'ttl' => 1, 
    'cache_dir' => 'cache', 
    'dir_permission' => 0755,
    'file_permission' => 0666]);

use Zend\Cache\PatternFactory;

$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);

Document::html()->scripts()->appendSrc('manual/js/formTools.js');
echo Document::html()->body()->addCssClass('manual')->getOpeningTag();

use Sphp\Manual\MVC\SideNavViewer;
use Sphp\Core\Path;

$res = \Sphp\Core\Util\FileUtils::parseYaml(Path::get()->local('manual/yaml/links.yaml'));
?>

<?php
$outputCache->start('topbar1212');
include("manual/templates/logo-area.php");
include('manual/__topBar.php');
$outputCache->end();
?>
<div class="row expanded small-collapse medium-uncollapse">
  <div class="column medium-3 large-3 xlarge-2 show-for-large">
    <?php
    $sidenawViewer = (new SideNavViewer($res[0]));
    $sidenawViewer->getMenu()->addCssClass('sphp-sidenav');
    $sidenawViewer->printHtml();
    ?>
  </div>
  <div class="mainContent small-12 large-9 xlarge-9 column"> 
    <?php
    include('manual/manualBuilder.php');
    ?>
  </div>
  <div class="show-for-xlarge xlarge-1 column"> 
  </div>
</div>

<?php
include('manual/_footer_.php');

use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
        ->setTitle('Back To Top')
        ->printHtml();
$html->documentClose();
