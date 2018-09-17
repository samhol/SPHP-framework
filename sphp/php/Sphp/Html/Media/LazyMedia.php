<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\Content;

/**
 * Defines lazy loading of images, videos and other resources
 * 
 * SPHP framework uses Lazy Load XT jQuery plugin. It is Mobile-oriented, fast 
 * and extensible jQuery plugin with build-in support of jQueryMobile framework.

 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/ressio/lazy-load-xt Lazy Load XT jQuery plugin
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface LazyMedia extends Content {

  /**
   * Sets or unsets the media source loading as lazy
   * 
   * @param  boolean $lazy true for lazy loading, false otherwise
   * @return $this for a fluent interface
   */
  public function setLazy(bool $lazy = true);

  /**
   * Checks whether the media source loading is lazy
   * 
   * @return boolean true for lazy loading, false otherwise
   */
  public function isLazy(): bool;
}
