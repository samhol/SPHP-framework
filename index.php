<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Router;
use Sphp\Html\Document;

include_once('manual/settings.php');
include_once('manual/links.php');
include_once(\Sphp\PDO_SESSIONING);
ob_implicit_flush(true);
include_once('manual/htmlHead.php');

Document::html('manual')->scripts()->appendSrc('manual/js/formTools.js');
?>
<body class="manual">
  <?php 
  include("manual/templates/logo-area.php");
  include_once('manual/__topBar.php');
  ?>
  <div class="row expanded small-collapse medium-uncollapse">
    <div class="column medium-3 large-3 xlarge-2 show-for-large">

      <?php
      include_once('manual/sidenav.php');
      ?>
    </div>
    <div class="mainContent small-12 large-9 xlarge-9 column"> 
      <?php
      include_once('manual/manualBuilder.php');
      ?>
    </div>
    <div class="show-for-xlarge xlarge-1 column"> 
    </div>
  </div>

  <?php
  include_once('manual/_footer_.php');

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();
  
