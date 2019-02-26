<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Config\Config;
use Sphp\Html\Media\Icons\BrandIcons;
?>
<div class="grid-x full sphp-logo-area">
  <div class="cell small-12 medium-auto">
    <ul class="logo">
      <li>
        <img src="/manual/pics/sphplayground.png" width="528" height="49" alt="SPHPlayground framework">
      </li>
    </ul>
  </div>
  <div class="cell hide-for-small-only medium-shrink icon-col">
    <?php
    $bi = new BrandIcons();
    $bi->github('https://github.com/samhol/SPHP-framework', 'Gihub repository');
    $bi->facebook('https://www.facebook.com/Sami.Petteri.Holck.Playground/', 'Facebook page');
    // $bi->googlePlus('https://plus.google.com/b/113942361282002156141/113942361282002156141', 'Google plus page');
    $bi->twitter('https://twitter.com/SPHPframework', 'Twitter page');
    $bi->addCssClass('smooth')->printHtml();
    ?>
  </div>
</div>
