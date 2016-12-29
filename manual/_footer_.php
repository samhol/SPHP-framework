<?php

use Sphp\Html\Apps\TechLinkList;
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

    <div class="small-12 large-8 xlarge-8 columns end">
      <div class="row">
        <div class="columns small-12">
          <?php
          if ($outputCache->start('footer_links') === false) {
            include 'manual/footerLinks.php';
            $outputCache->end();
          }
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
