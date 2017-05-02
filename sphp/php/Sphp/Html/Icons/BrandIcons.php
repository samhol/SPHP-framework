<?php

/**
 * BrandIcons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;

/**
 * Description of BrandIcons
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BrandIcons extends AbstractComponent {

  /**
   * @var AbstractIcon[] 
   */
  private $icons;

  public function __construct() {
    parent::__construct('ul');
    $this->icons = [];
    $this->cssClasses()->lock('sphp-brand-icons');
    //$ul = (new \Sphp\Html\Lists\Ul());

    /* $blee = new Dropdown(F::icon('widget'));
      $blee->closeOnBodyClick()
      ->align('bottom left')
      ->addCssClass('sphp-f6-info large')
      ->ajaxPrepend('manual/snippets/f6ScreenInfo.php'); */

//$ul[] = $blee;
    /* $ul['github'] = (new HyperlinkListItem('https://github.com/samhol/SPHP-framework', '<i class="fa fa-github"></i>', '_blank'))->addCssClass('github');
      $ul['facebook'] = (new HyperlinkListItem('https://www.facebook.com/Sami.Petteri.Holck.Programming/', '<i class="fa fa-facebook-square"></i>', '_blank'))->addCssClass('facebook');
      $ul['google'] = (new HyperlinkListItem('https://plus.google.com/b/113942361282002156141/113942361282002156141', '<i class="fa fa-google-plus-square"></i>', '_blank'))->addCssClass('google');
      $ul['twitter'] = (new HyperlinkListItem('https://twitter.com/SPHPframework', '<i class="fa fa-twitter"></i>', '_blank'))->addCssClass('twitter');
     */
    //->printHtml();
    //$ul
    //$ul->addCssClass('sphp-brand-icons rounded')
    //       ->printHtml();
  }

  public function setFacebook($url = null) {
    if ($url) {
      $url = 'https://www.facebook.com/';
    }
    $this->setIcon('facebook', (new HyperlinkIcon($url, Icon::fontAwesome('facebook-square'), '_blank')));
    return $this;
  }

  protected function setIcon($index, HyperlinkIcon $icon) {
    $this->icons[$index] = $icon;
    $icon->addCssClass($index);
    return $this;
  }

  public function contentToString() {
    $output = '';
    foreach ($this->icons as $icon) {
      $output .= "<li>$icon</li>";
    }
    return $output;
  }

}
