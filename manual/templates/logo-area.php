<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Config\Config;
use Sphp\Html\Media\Icons\BrandIcons;
?>
<div class="grid-x full sphp-logo-area">
  <div class="cell small-12 medium-6">
    <ul class="logo">
      <li>
        <a href="<?php echo Config::instance('manual')->get('ROOT_URL') ?>" target="_self" title="Navigate back to frontpage" data-sphp-qtip>
          <img src="http://playground.samiholck.com/manual/pics/sphplayground.png" width="528" height="49" alt="SPHPlayground framework">
        </a>
      </li>
    </ul>
  </div>
  <div class="cell small-12 medium-6 icon-col">
    <?php
    $bi = new BrandIcons();
    $bi->github('https://github.com/samhol/SPHP-framework', 'Gihub repository');
    $bi->facebook('https://www.facebook.com/Sami.Petteri.Holck.Playground/', 'Facebook page');
    $bi->googlePlus('https://plus.google.com/b/113942361282002156141/113942361282002156141', 'Google plus page');
    $bi->twitter('https://twitter.com/SPHPframework', 'Twitter page');
    $bi->addCssClass('smooth')->printHtml();
    ?>
  </div>
</div>
