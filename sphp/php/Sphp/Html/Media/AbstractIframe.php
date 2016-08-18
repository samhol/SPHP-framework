<?php

/**
 * AbstractIframe.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent as AbstractComponent;

/**
 * Class Models an HTML &lt;iframe&gt; tag (an inline frame).
 *
 * The {@link self} component represents a nested browsing context.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-14
 * @link    http://www.w3schools.com/tags/tag_iframe.asp w3schools HTML API link
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-iframe-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractIframe extends AbstractComponent implements IframeInterface {

  use SizeableTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct("iframe");
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return "<p>Your browser does not support iframes.</p>";
  }

}
