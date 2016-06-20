<?php

namespace Sphp\Html\Foundation\F6\Navigation;

use Sphp\Core\PathFinder as PathFinder;
use Sphp\Html\Document as Document;
error_reporting(E_ALL);
ini_set("display_errors", 1);
//require_once __DIR__ . '/vendor/autoload.php';
include_once("manual/settings.php");
include_once("manual/links.php");
include_once(\Sphp\PDO_SESSIONING);
ob_implicit_flush(true);
include_once("manual/htmlHead.php");

Document::html("manual")->scripts()->appendSrc("manual/js/formTools.js");
?>
<body class="manual" id="manual-body">
  <div class="sphp-logo">
    <a href="<?php echo (new PathFinder)->http() ?>" target="_self" title="Navigate back to frontpage" data-sphp-qtip>
      <img src="manual/pics/sphp-code-logo.png" alt="SPHP framework">
    </a>
    <?php

    use Sphp\Html\Foundation\F6\Containers\Dropdown as Dropdown;
    use Sphp\Html\Foundation\F6\Foundation as F;

$ul = (new \Sphp\Html\Lists\Ul())->addCssClass("social-icons");

    $blee = new Dropdown(F::icon("widget"));
    $blee->closeOnBodyClick()
            ->align("bottom left")
            ->addCssClass("sphp-f6-info large")
            ->ajaxPrepend("manual/snippets/f6ScreenInfo.php");

    //$ul[] = $blee;
    $ul->appendLink("https://github.com/samhol/SPHP-framework", '<i class="fa fa-github"></i>', "_blank")
            ->appendLink("https://www.facebook.com/Sami.Petteri.Holck.Programming/", '<i class="fa fa-facebook-square"></i>', "_blank")
            ->appendLink("https://twitter.com/SPHPframework", '<i class="fa fa-twitter"></i>', "_blank")
            ->appendLink("https://plus.google.com/b/113942361282002156141/113942361282002156141", '<i class="fa fa-google-plus-square"></i>', "_blank")
            ->addCssClass("no-bullet")
            ->printHtml();
    ?>
  </div>
  <?php
  include_once("manual/__topBar.php");
  ?>
  <div class="row expanded small-collapse medium-uncollapse">
    <div class="column medium-3 large-3 xlarge-2 show-for-large">

      <?php
      include_once("manual/sidenav.php");
      ?>
    </div>
    <div class="mainContent small-12 large-9 xlarge-8 column"> 
      <?php
      include_once("manual/manualBuilder.php");
      ?>
    </div>
    <div class="show-for-xlarge xlarge-2 column"> 

    </div>
  </div>


  <?php
  include_once("manual/_footer_.php");

  use Sphp\Html\Apps\BackToTopButton as BackToTopButton;

$backToTopBtn = new BackToTopButton();
  $backToTopBtn
          ->setTitle("Back To Top")
          ->printHtml();
  $html->documentClose();
  ?>
