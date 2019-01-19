<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements the LazyMedia interface
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
   * @param  boolean $lazy true if the loading is lazy, false otherwise
   * @return $this for a fluent interface
   */
  public function setLazy(bool $lazy = true) {
    $classes = ['lazy-hidden', 'lazy-loaded'];
    if ($lazy && !$this->isLazy()) {
      $this->attributes()->classes()->add($classes);
      $this->attributes()->setAttribute('data-src', $this->attributes()->getValue('src'));
      $this->attributes()->remove('src');
    } else if (!$lazy && $this->isLazy()) {
      $this->attributes()->classes()->remove($classes);
      $this->attributes()->setAttribute('src', $this->attributes()->getValue('data-src'));
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
    return $this->attributes()->isVisible('data-src') &&
            $this->attributes()->classes()->contains(['lazy-hidden', 'lazy-loaded']);
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src = null) {
    if ($this->isLazy()) {
      $this->attributes()->setAttribute('data-src', $src);
      $this->attributes()->remove('src');
    } else {
      $this->attributes()->setAttribute('src', $src);
      $this->attributes()->remove('data-src');
    }
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    if ($this->isLazy()) {
      return (string) $this->attributes()->getValue('data-src');
    } else {
      return (string) $this->attributes()->getValue('src');
    }
  }

}
