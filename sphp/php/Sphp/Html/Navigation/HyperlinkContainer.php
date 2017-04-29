<?php

/**
 * HyperlinkContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkInterface;

/**
 * Implements a hyperlink container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-04
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkContainer extends AbstractContainerTag implements HyperlinkInterface {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $tagName the tag name of the component
   * @param  Hyperlink|null $hyperlink the inner hyperlink object or null
   */
  public function __construct($tagName, Hyperlink $hyperlink = null) {
    if ($hyperlink === null) {
      $hyperlink = new Hyperlink();
    }
    parent::__construct($tagName, null, $hyperlink);
  }

  /**
   * Returns the actual hyperlink component in the menu item component
   * 
   * @return Hyperlink the actual hyperlink component in the menu item component
   */
  public function getHyperlink() {
    return $this->getInnerContainer();
  }

  /**
   * {@inheritdoc}
   */
  public function getHref() {
    return $this->getHyperlink()->getHref();
  }

  /**
   * {@inheritdoc}
   */
  public function setHref($href, $encode = true) {
    $this->getHyperlink()->setHref($href, $encode);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setTarget($target) {
    $this->getHyperlink()->setTarget($target);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTarget() {
    return $this->getHyperlink()->getTarget();
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle($title) {
    $this->getHyperlink()->setAttr("title", $title);
    return $this;
  }

}
