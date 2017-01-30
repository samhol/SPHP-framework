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
          <button class="menu-icon" type="button" data-open="offCanvasLeftSPlit1"></button>
          <button class="menu-icon" type="button" data-open="offCanvasLeftSPlit1"></button>
          <span class="title-bar-title">Foundation</span>
          <button class="menu-icon" type="button" data-open="offCanvasLeftSPlit1"></button>
          <button class="fi fi-arrow-up" type="button" data-open="offCanvasLeftSPlit1" style="color:#fff"></button>
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
          <span class="title-bar-title">Foundation 0</span>
          <span class="title-bar-title">Foundation 1</span>
          <button class="menu-icon" type="button" data-open="offCanvasRight"></button>
        </div>
      </div>
      
      <div class="top-bar">
  <div class="top-bar-title">
    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <button class="menu-icon dark" type="button" data-toggle></button>
    </span>
    <strong>Site Title</strong>
  </div>
  <div id="responsive-menu">
    <div class="top-bar-left">
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
    <div class="top-bar-right">
      <ul class="menu">
        <li><input type="search" placeholder="Search"></li>
        <li><button type="button" class="button">Search</button></li>
      </ul>
    </div>
  </div>
</div>
      <pre>
        <?php
$data = \Sphp\Core\Util\FileUtils::parseYaml(Path::get()->local('manual/yaml/documentation_links.yaml'));
print_r($data);
echo Factory::buildMenu($data, new AccordionMenu);
$v = \Sphp\Core\Util\FileUtils::parseYaml(Path::get()->local('manual/yaml/dependencies_links.yml'));
$dep = new AccordionMenu();
$dep->appendText('dependencies');
echo Factory::buildMenu($v, $dep);
$apis = \Sphp\Core\Util\FileUtils::parseYaml(Path::get()->local('manual/yaml/apidocs_menu.yml'));
$topbar = new TopBar();
$topbar->left()->append(Factory::buildSub($data));
$topbar->left()->append(Factory::buildSub($v));
$topbar->left()->append(Factory::buildSub($apis));
$topbar->printHtml();
        ?>
      </pre>
    
    <button type="button" class="button" data-toggle="offCanvasLeftSPlit1">Open Left</button>
<button type="button" class="button" data-toggle="offCanvasRightSplit2">Open Right</button>

<div class="row">
  <div class="small-6 columns">
    <div class="off-canvas-wrapper">
      <div class="off-canvas-absolute position-left" id="offCanvasLeftSPlit1" data-off-canvas>
        <!-- Your menu or Off-canvas content goes here -->
        zdfnzdf<div class="callout">earerhrae</div>
      </div>
      <div class="off-canvas-content" style="min-height: 300px;" data-off-canvas-content>
        <p>I have nothing to do with the off-canvas on the right!</p>
      </div>
    </div>
  </div>
  <div class="small-6 columns">
    <div class="off-canvas-wrapper">
      <div class="off-canvas-absolute position-right" id="offCanvasRightSplit2" data-off-canvas>
        <!-- Your menu or Off-canvas content goes here -->
      </div>
      <div class="off-canvas-content" style="min-height: 300px;" data-off-canvas-content>
        <p>Im a unique off-canvas container all on my own!</p>
      </div>
    </div>
  </div>
</div></div>
    <div class="show-for-xlarge xlarge-1 column"> 
      
      
    </div>
  </div>

  <?php
  

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();



  
