<?php

use Sphp\Html\Apps\TechLinkList;
?>
<div class="footer">
  <div class="grid-x grid-margin-x grid-padding-x">
    <div class="cell small-12 large-4 xlarge-3 skull text-center">
      <img src="manual/pics/footer_skull.png" alt="skull">
      <?php
      $techLinks = new TechLinkList();
      $techLinks->printHtml();
      ?>
    </div>

    <div class="cell small-12 large-8 xlarge-8 end">
      <?php include 'footerLinks.php'; ?>
    </div>
  </div>

  <footer class="text-center">
    <div >
      <?php include_once 'licenseRevealer.php' ?>
    </div>
  </footer> 
</div>
