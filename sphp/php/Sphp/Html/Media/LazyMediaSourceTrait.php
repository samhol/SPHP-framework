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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait LazyMediaSourceTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attributes(): HtmlAttributeManager;

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
      $this->attributes()->classes()->add($classes);
      $this->attributes()->set('data-src', $src);
    } else if ($this->isLazy()) {
      $this->attributes()->classes()->remove($classes);
      $this->setSrc($this->attributes()->getValue('data-src'));
      $this->attributes()->remove('data-src');
    }
    return $this;
  }

  /**
   * Checks whether the media source loading is lazy
   * 
   * @return boolean true if the loading is lazy, false otherwise
   */
  public function isLazy(): bool {
    return $this->attributes()->exists('data-src') &&
            $this->attributes()->classes()->contains(['lazy-hidden', 'lazy-loaded']);
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
      $this->attributes()->set('data-src', $src);
    } else {
      $this->attributes()->set('src', $src);
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
      return $this->attributes()->getValue('data-src');
    } else {
      return $this->attributes()->getValue('src');
    }
  }

}
