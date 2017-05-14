<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Path;
?>
<div class="row expanded sphp-logo-area">
  <div class="column small-12 large-6">
    <ul class="logo menu">
      <li>
        <a href="<?php echo Path::get()->http() ?>" target="_self" title="Navigate back to frontpage" data-sphp-qtip>
          <img src="manual/pics/sphp-code-logo.png" alt="SPHP framework">
        </a>
      </li>
    </ul>
  </div>
  <div class="column small-12 large-6 text-right">
    <?php


            use Sphp\Html\Icons\BrandIcons;
            $bi = new BrandIcons();
            
            $bi->setGithub('https://github.com/samhol/SPHP-framework');
            $bi->setFacebook('https://www.facebook.com/Sami.Petteri.Holck.Programming/');
            $bi->setGooglePlus('https://plus.google.com/b/113942361282002156141/113942361282002156141');
            $bi->setTwitter('https://twitter.com/SPHPframework');
            $bi->addCssClass('rounded');
            $bi->printHtml();
    ?>
  </div>
</div>
