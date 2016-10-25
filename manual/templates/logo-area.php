<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Router;
?>
<div class="row expanded sphp-logo-area">
  <div class="column small-12 large-6">
    <ul class="logo menu"><li>
      <a href="<?php echo Router::get()->http() ?>" target="_self" title="Navigate back to frontpage" data-sphp-qtip>
        <img src="manual/pics/sphp-code-logo.png" alt="SPHP framework">
      </a></li>
    </ul>
  </div>
  <div class="column small-12 large-6">
    <?php

    //use Sphp\Html\Foundation\Sites\Containers\Dropdown;
    //use Sphp\Html\Foundation\Sites\Foundation as F;

    $ul = (new \Sphp\Html\Lists\Ul())->addCssClass('social-icons menu simple');

    /*$blee = new Dropdown(F::icon('widget'));
    $blee->closeOnBodyClick()
            ->align('bottom left')
            ->addCssClass('sphp-f6-info large')
            ->ajaxPrepend('manual/snippets/f6ScreenInfo.php');*/

//$ul[] = $blee;
    $ul->appendLink('https://github.com/samhol/SPHP-framework', '<i class="fa fa-github"></i>', '_blank')
            ->appendLink('https://www.facebook.com/Sami.Petteri.Holck.Programming/', '<i class="fa fa-facebook-square"></i>', '_blank')
            ->appendLink('https://twitter.com/SPHPframework', '<i class="fa fa-twitter"></i>', '_blank')
            ->appendLink('https://plus.google.com/b/113942361282002156141/113942361282002156141', '<i class="fa fa-google-plus-square"></i>', '_blank')
            ->addCssClass('no-bullet')
            ->printHtml();
    ?>
  </div>
</div>
