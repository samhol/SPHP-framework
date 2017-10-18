<?php

/**
 * BrandIcons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\ContentInterface;
use Sphp\Html\Lists\Ul;
use Iterator;

/**
 * Description of BrandIcons
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BrandIcons implements ContentInterface, Iterator {

  use \Sphp\Html\ContentTrait;

  const GITHUB = 'github';
  const FACEBOOK = 'facebook';
  const GOOGLE_PLUS = 'google-plus';
  const TWITTER = 'twitter';

  /**
   * @var AbstractIcon[] 
   */
  private $icons;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    //parent::__construct('ul');
    $this->icons = [];
    //$this->cssClasses()->lock('brand-icons');
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return $this for a fluent interface
   */
  public function setGithub(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://www.github.com/';
    }
    $this->setIcon(static::GITHUB, (new HyperlinkIcon($url, Icons::fontAwesome('github'), $target)));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return $this for a fluent interface
   */
  public function setFacebook(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://www.facebook.com/';
    }
    $this->setIcon(static::FACEBOOK, (new HyperlinkIcon($url, Icons::fontAwesome('facebook-square'), $target)));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return $this for a fluent interface
   */
  public function setTwitter(string $url = 'https://twitter.com/', string $target = null) {
    $this->setIcon(static::TWITTER, HyperlinkIcon::fontAwesome($url, 'twitter', $target));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return $this for a fluent interface
   */
  public function setGooglePlus(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://plus.google.com/';
    }
    $this->setIcon(static::GOOGLE_PLUS, (new HyperlinkIcon($url, Icons::fontAwesome('google-plus-square'), $target)));
    return $this;
  }

  /**
   * 
   * @param  string $index
   * @return HyperlinkIcon
   * @throws \Sphp\Exceptions\RuntimeException if there is no icon at the given index
   */
  public function get(string $index): HyperlinkIcon {
    if (array_key_exists($index, $this->icons)) {
      return $this->icons[$index];
    } else {
      throw new \Sphp\Exceptions\RuntimeException("There is no Hyperlink icon at index '$index'");
    }
    return null;
  }

  /**
   * 
   * @param  string $index
   * @param  HyperlinkIcon $icon
   * @return $this for a fluent interface
   */
  protected function setIcon(string $index, HyperlinkIcon $icon) {
    $this->icons[$index] = $icon;
    $icon->addCssClass($index);
    return $this;
  }

  public function getHtml(): string {
    $ul = new Ul($this->icons);
    $ul->addCssClass('brand-icons', 'rounded', 'logo');
    return $ul->getHtml();
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
  public function valid(): bool {
    return false !== current($this->icons);
  }

}
