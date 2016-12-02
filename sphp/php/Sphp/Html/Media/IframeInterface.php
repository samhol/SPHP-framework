<?php

/**
 * IframeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Defines an HTML &lt;iframe&gt; tag (an inline frame).
 *
 * The {@link self} component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-14
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface IframeInterface extends LazyLoaderInterface, SizeableInterface {

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method sets the value of the 
   * `data-src` attribute instead of the `src` attribute
   *
   * @param  string|URL $src the path to the image source (The URL of the image file)
   * @return LazyLoaderInterface for PHP Method Chaining
   */
  public function setSrc($src);

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method returns the value of the 
   * `data-src` attribute instead of the `src` attribute
   * 
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc();
}
