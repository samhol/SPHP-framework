<?php

/**
 * HyperlinkTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Stdlib\Strings;

/**
 * Trait implements {@link HyperlinkInterface} for hyperlink functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait HyperlinkTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attributes(): HtmlAttributeManager;

  /**
   * Sets the value of the href attribute (The URL of the link)
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $href the URL of the link
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref(string $href) {
    $this->attributes()->set('href', $href);
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
    return $this->attributes()->getValue('href');
  }

  /**
   * Sets the value of the target attribute
   *
   * **Notes:**
   *
   * * The target attribute specifies where to open the linked document.
   * * Only used if the href attribute is present.
   *
   * @param  string|null $target optional target frame of the hyperlink
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget(string $target = null) {
    if (!Strings::isEmpty($target)) {
      $this->attributes()->set('target', $target);
    } else {
      $this->attributes()->remove('target');
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
    return $this->attributes()->getValue('target');
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle(string $title) {
    return $this->setAttr('title', $title);
  }

}
