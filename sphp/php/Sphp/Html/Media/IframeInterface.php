<?php

/**
 * IframeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Interface defines an HTML &lt;iframe&gt; tag (an inline frame).
 *
 * The {@link self} component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-14
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API link
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface IframeInterface extends LazyLoaderInterface, SizeableInterface {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "iframe";

}
