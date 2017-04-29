<?php

/**
 * HyperlinkTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Attributes\AttributeManager;
use Sphp\Stdlib\Strings;

/**
 * Trait implements {@link HyperlinkInterface} for hyperlink functionality
 *
 * If a {@link HyperlinkInterface} component has an href attribute, then it
 * represents a hyperlink (a hypertext anchor). If the component has no href
 * attribute, then the component represents a placeholder for where a link might
 * otherwise have been placed, if it had been relevant.
 *
 * The `target`, `rel`, `media`, `hreflang`, and `type` attributes must be omitted if
 * the `href` attribute is not present.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait HyperlinkTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Sets the value of the href attribute (The URL of the link)
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $href the URL of the link
   * @param  boolean $encode converts all applicable characters of the $url to
   *         HTML entities
   * @return HyperlinkInterface for PHP Method Chaining
   * @uses   Strings::htmlEncode()
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref($href, $encode = true) {
    if ($encode) {
      $href = Strings::htmlEncode($href);
    }
    $this->attrs()->set('href', $href);
    return $this;
  }

  /**
   * Returns the value of the href attribute
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @return string the value of the href attribute
   * @link http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function getHref() {
    return $this->attrs()->get('href');
  }

  /**
   * Sets the value of the target attribute
   *
   * **Notes:**
   *
   * * The target attribute specifies where to open the linked document.
   * * Only used if the href attribute is present.
   *
   * @param  string $target the value of the target attribute
   * @return HyperlinkInterface for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget($target) {
    if (!Strings::isEmpty($target)) {
      $this->attrs()->set('target', $target);
    } else {
      $this->attrs()->remove('target');
    }
    return $this;
  }

  /**
   * Returns the value of the target attribute
   *
   * **Notes:**
   *
   * * The target attribute specifies where to open the linked document.
   * * Only used if the href attribute is present.
   *
   * @return string the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function getTarget() {
    return $this->attrs()->get('target');
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle($title) {
    return $this->setAttr("title", $title);
  }

}
