<?php

/**
 * LazyLoaderTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements the {@link LazyLoaderInterface} interface
 * 
 * Mobile-oriented, fast and extensible jQuery plugin for lazy loading of 
 * images/videos with build-in support of jQueryMobile framework.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_img.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @link    https://github.com/ressio/lazy-load-xt Lazy Load XT jQuery plugin
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait LazyMediaSourceTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Sets or unsets the media source loading as lazy
   * 
   * **Important:** if the `$lazy = true` the actual media source path is stored into the  
   * `data-src` attribute instead of the `src` attribute
   * 
   * @param  boolean $lazy true if the loading is lazy, false otherwise
   * @return $this for a fluent interface
   */
  public function setLazy(bool $lazy = true) {
    $classes = ['lazy-hidden', 'lazy-loaded'];
    if ($lazy && !$this->isLazy()) {
      $src = $this->getSrc();
      $this->setSrc(false);
      $this->attrs()->classes()->add($classes);
      $this->attrs()->set('data-src', $src);
    } else if ($this->isLazy()) {
      $this->attrs()->classes()->remove($classes);
      $this->setSrc($this->attrs()->getValue('data-src'));
      $this->attrs()->remove('data-src');
    }
    return $this;
  }

  /**
   * Checks whether the media source loading is lazy
   * 
   * @return boolean true if the loading is lazy, false otherwise
   */
  public function isLazy(): bool {
    return $this->attrs()->exists('data-src') &&
            $this->attrs()->classes()->contains(['lazy-hidden', 'lazy-loaded']);
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method sets the value of the 
   * `data-src` attribute instead of the `src` attribute
   *
   * @param  string $src the path to the image source (The URL of the image file)
   * @return LazyLoaderInterface for PHP Method Chaining
   */
  public function setSrc(string $src) {
    if ($this->isLazy()) {
      $this->attrs()->set('data-src', $src);
    } else {
      $this->attrs()->set('src', $src);
    }
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method returns the value of the 
   * `data-src` attribute instead of the `src` attribute
   * 
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    if ($this->isLazy()) {
      return $this->attrs()->getValue('data-src');
    } else {
      return $this->attrs()->getValue('src');
    }
  }

}
