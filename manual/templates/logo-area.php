<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Path;
use Sphp\Html\Lists\HyperlinkListItem;

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
  <div class="column small-12 large-6">
    <?php
    //use Sphp\Html\Foundation\Sites\Containers\Dropdown;
    //use Sphp\Html\Foundation\Sites\Foundation as F;

    $ul = (new \Sphp\Html\Lists\Ul());

    /* $blee = new Dropdown(F::icon('widget'));
      $blee->closeOnBodyClick()
      ->align('bottom left')
      ->addCssClass('sphp-f6-info large')
      ->ajaxPrepend('manual/snippets/f6ScreenInfo.php'); */

//$ul[] = $blee;
    $ul['github'] = (new HyperlinkListItem('https://github.com/samhol/SPHP-framework', '<i class="fa fa-github"></i>', '_blank'))->addCssClass('github');
    $ul['facebook'] = (new HyperlinkListItem('https://github.com/samhol/SPHP-framework', '<i class="fa fa-facebook-square"></i>', '_blank'))->addCssClass('facebook');
    $ul->appendLink('https://github.com/samhol/SPHP-framework', '<i class="fa fa-github"></i>', '_blank')
            ->appendLink('https://www.facebook.com/Sami.Petteri.Holck.Programming/', '<i class="fa fa-facebook-square"></i>', '_blank')
            ->appendLink('https://twitter.com/SPHPframework', '<i class="fa fa-twitter"></i>', '_blank')
            ->appendLink('https://plus.google.com/b/113942361282002156141/113942361282002156141', '<i class="fa fa-google-plus-square"></i>', '_blank')
            //->printHtml();

    //$ul
            ->addCssClass('sphp-brand-icons rounded')
            ->printHtml();

    ?>
  </div>
</div>
