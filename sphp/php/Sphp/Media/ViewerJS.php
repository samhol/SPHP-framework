<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

/**
 * Implements VideoJS component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ViewerJS extends Iframe {

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string|URL $src the path to the image source (The URL of the image file)
   * @return LazyLoaderInterface for PHP Method Chaining
   */
  public function setSrc(string $src = null) {
    parent::setSrc("./sphp/viewerjs/index.html#../../$src");
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
    $src = \Sphp\Stdlib\Strings::trimLeft(parent::getSrc(), 'sphp/viewerjs/#../../');
    return $src;
  }

}
