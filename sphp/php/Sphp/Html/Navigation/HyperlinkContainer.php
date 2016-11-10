<?php

/**
 * HyperlinkContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Core\Types\Strings;
use Sphp\Core\Types\URL;

/**
 * Implements {@link HyperlinkInterface} properties in a menu item
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
   * @param  string|URL $href the URL of the link
   * @param  string $content optional content of the component
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($tagName, $href = null, $content = null, $target = null) {
    parent::__construct($tagName, null, new Hyperlink());
    if (!Strings::isEmpty($href)) {
      $this->setHref($href);
    }
    if (!Strings::isEmpty($target)) {
      $this->setTarget($target);
    }if ($content !== null) {
      $this->append($content);
    }
  }

  /**
   * Sets the actual hyperlink component in the menu item component
   * 
   * @param Hyperlink $hyperlink the actual hyperlink component in the menu 
   *        item component
   * @return self for PHP Method Chaining
   */
  public function setHyperlink(Hyperlink $hyperlink) {
    $this->setInnerContainer($hyperlink);
    return $this;
  }

  /**
   * Returns the actual hyperlink component in the menu item component
   * 
   * @return Hyperlink the actual hyperlink component in the menu item component
   */
  public function getHyperlink() {
    return $this->getInnerContainer();
  }

  public function getHref() {
    return $this->getHyperlink()->getHref();
  }

  public function setHref($href, $encode = true) {
    $this->getHyperlink()->setHref($href, $encode);
    return $this;
  }

  public function setTarget($target) {
    $this->getHyperlink()->setTarget($target);
    return $this;
  }

  public function getTarget() {
    return $this->getHyperlink()->getTarget();
  }

  public function urlEquals($currentUrl = null) {
    return $this->getHyperlink()->urlEquals($currentUrl);
  }

  public function isCurrentUrl() {
    return $this->getHyperlink()->isCurrentUrl();
  }

}
