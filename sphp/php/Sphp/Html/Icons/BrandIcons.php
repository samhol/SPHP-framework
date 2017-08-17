<?php

/**
 * BrandIcons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\AbstractComponent;
use Iterator;
use Sphp\Html\TraversableInterface;
/**
 * Description of BrandIcons
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BrandIcons extends AbstractComponent implements Iterator, TraversableInterface {

  use \Sphp\Html\TraversableTrait;

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
    parent::__construct('ul');
    $this->icons = [];
    $this->cssClasses()->lock('brand-icons');
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return self for a fluent interface
   */
  public function setGithub(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://www.github.com/';
    }
    $this->setIcon(static::GITHUB, (new HyperlinkIcon($url, Icon::fontAwesome('github'), $target)));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return self for a fluent interface
   */
  public function setFacebook(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://www.facebook.com/';
    }
    $this->setIcon(static::FACEBOOK, (new HyperlinkIcon($url, Icon::fontAwesome('facebook-square'), $target)));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return self for a fluent interface
   */
  public function setTwitter(string $url = 'https://twitter.com/', string $target = null) {
    $this->setIcon(static::TWITTER, HyperlinkIcon::fontAwesome($url, 'twitter', $target));
    return $this;
  }

  /**
   * 
   * @param  string $url
   * @param  string|null $target optional target of  the hyperlink
   * @return self for a fluent interface
   */
  public function setGooglePlus(string $url = null, string $target = null) {
    if ($url === null) {
      $url = 'https://plus.google.com/';
    }
    $this->setIcon(static::GOOGLE_PLUS, (new HyperlinkIcon($url, Icon::fontAwesome('google-plus-square'), $target)));
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
   * @param  \Sphp\Html\Icons\HyperlinkIcon $icon
   * @return self for a fluent interface
   */
  protected function setIcon(string $index, HyperlinkIcon $icon) {
    $this->icons[$index] = $icon;
    $icon->addCssClass($index);
    return $this;
  }

  public function contentToString(): string {
    $output = '';
    foreach ($this->icons as $icon) {
      $output .= "<li>$icon</li>";
    }
    return $output;
  }

  public function count(): int {
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
