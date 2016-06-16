<?php

/**
 * AbstractIframe.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;

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
abstract class AbstractIframe extends AbstractContainerComponent implements IframeInterface {

  use SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct() {
    parent::__construct(self::TAG_NAME);
    $this->content()->set("unsupported", "<p>Your browser does not support iframes.</p>");
  }

  /**
   * {@inheritdoc}
   */
  public function isLazy() {
    return $this->attrExists("data-src") && $this->hasCssClass("lazy-hidden lazy-loaded");
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    if ($lazy && !$this->isLazy()) {
      $src = $this->getAttr("src");
      $this->removeAttr("src");
      $this->addCssClass("lazy-hidden lazy-loaded");
      $this->setAttr("data-src", $src);
    } else if ($this->isLazy()) {
      $this->removeCssClass("lazy-hidden lazy-loaded")
              ->setAttr($this->getAttr("data-src"))
              ->removeAttr("data-src");
    }
    return $this;
  }

}
