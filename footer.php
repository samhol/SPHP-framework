<?php

use Sphp\Html\Foundation\F6\Containers\Dropdown as Dropdown;
use Sphp\Html\Foundation\F6\Foundation as F;
use Sphp\Html\Apps\TechLinkList as TechLinkList;
?>
<div class="footer">
  <div class="row">
    <div class="small-12 large-4 xlarge-3 columns skull text-center">
      <img src="manual/pics/footer_skull.png" alt="skull">
      <?php
      $techLinks = new TechLinkList();
      $techLinks->printHtml();
      ?>
    </div>

    <div class="small-12 large-8 xlarge-9 columns">
      <div class="row">
        <div class="columns small-12 xlarge-11">
          <?php include_once 'manual/footerLinks.php' ?>
        </div>

        <div class="columns small-12 xlarge-1 social-etc">
          <?php
          $ul = (new Sphp\Html\Lists\Ul())->addCssClass("icons");

          $blee = new Dropdown(F::icon("widget"));
          $blee->closeOnBodyClick()
                  ->align("bottom left")
                  ->addCssClass("sphp-f6-info large")
                  ->ajaxPrepend("manual/snippets/f6ScreenInfo.php");

          $ul[] = $blee;
          $ul->appendLink("https://github.com/samhol/SPHP-framework", '<i class="fi-social-github"></i>', "_blank")
                  ->appendLink("https://www.facebook.com/Sami.Petteri.Holck.Programming/", '<i class="fi-social-facebook"></i>', "_blank")
                  ->appendLink("https://twitter.com/SPHPframework", '<i class="fi-social-twitter"></i>', "_blank")
                  ->appendLink("https://plus.google.com/b/113942361282002156141/113942361282002156141", '<i class="fa fa-google-plus-square"></i>', "_blank")
                  ->addCssClass("no-bullet")
                  ->printHtml();
          ?>

        </div>
      </div>
    </div>
  </div>

  <footer class="text-center">
    <div >
      <?php include_once 'manual/licenseRevealer.php' ?>
    </div>
  </footer> 
</div>
