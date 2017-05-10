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
class BrandIcons extends AbstractComponent implements \Iterator, \Sphp\Html\TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  const FACEBOOK = 'facebook';
  const GOOGLE_PLUS = 'google-plus';
  const TWITTER = 'twitter';

  /**
   * @var AbstractIcon[] 
   */
  private $icons;

  public function __construct() {
    parent::__construct('ul');
    $this->icons = [];
    $this->cssClasses()->lock('brand-icons');
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

  /**
   * 
   * @param string $url
   * @param type $target
   * @return $this
   */
  public function setFacebook($url = null, $target = null) {
    if ($url === null) {
      $url = 'https://www.facebook.com/';
    }
    $this->setIcon('facebook', (new HyperlinkIcon($url, Icon::fontAwesome('facebook-square'), $target)));
    return $this;
  }

  /**
   * 
   * @param string $url
   * @param string|null $target
   * @return $this
   */
  public function setTwitter($url = 'https://twitter.com/', $target = null) {
    $this->setIcon(static::TWITTER, HyperlinkIcon::fontAwesome($url, 'twitter', $target));
    return $this;
  }

  /**
   * 
   * @param string $url
   * @return $this
   */
  public function setGooglePlus($url = null) {
    if ($url === null) {
      $url = 'https://plus.google.com/';
    }
    $this->setIcon(static::GOOGLE_PLUS, (new HyperlinkIcon($url, Icon::fontAwesome('google-plus-square'), '_blank')));
    return $this;
  }

  /**
   * 
   * @param  string $index
   * @return HyperlinkIcon|null
   */
  public function get($index) {
    if (array_key_exists($index, $this->icons)) {
      return $this->icons[$index];
    }
    return null;
  }

  /**
   * 
   * @param type $index
   * @param \Sphp\Html\Icons\HyperlinkIcon $icon
   * @return $this
   */
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

  public function count() {
    return count($this->icons);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->icons);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->icons);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->icons);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->icons);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->icons);
  }

}
