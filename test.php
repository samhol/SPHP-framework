<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;
use Sphp\Html\Document;

include_once('manual/settings.php');
include_once('manual/htmlHead.php');

?>
<body class="manual">
  <?php
  ?>
  <div class="row expanded small-collapse medium-uncollapse">

    <div class="mainContent small-12"> 
      <div class="title-bar">
        <div class="title-bar-left">
          <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
          <span class="title-bar-title">Foundation</span>
          <ul class="dropdown menu" data-dropdown-menu>

            <li>
              <a href="#">One</a>
              <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
              </ul>
            </li>
            <li><a href="#">Two</a></li>
            <li><a href="#">Three</a></li>
          </ul>
        </div>
        <div class="title-bar-right">
          <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
        </div>
      </div><pre>
        <?php
        
        phpinfo();
        $cache  = new \Zend\Cache\Storage\Adapter\Filesystem();
        $cache->setOptions([ 'ttl' => 3600,'cache_dir' => 'cache', 'dir_level' => 1]);


        use Zend\Cache\PatternFactory;




        //$outputCache->start('a');

        $res = \Sphp\Core\Util\FileUtils::parseYaml(Path::get()->local('manual/yaml/links.yaml'));
        print_r($res);

        use Sphp\Manual\MVC\SideNavViewer;

(new SideNavViewer($res))->printHtml();
        // $outputCache->end();
        ?>
      </pre></div>
    <div class="show-for-xlarge xlarge-1 column"> 
    </div>
  </div>

  <?php
  $outputCache = PatternFactory::factory('output', [
                    'storage' => $cache
        ]);
  $outputCache->start('footer');
  include('manual/_footer_.php');
 // $outputCache->end();

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();

$outputCache->end();

  