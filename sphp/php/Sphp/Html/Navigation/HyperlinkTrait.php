<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements {@link HyperlinkInterface} for hyperlink functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $this->attributes()->setAttribute('href', $href);
    return $this;
  }

  /**
   * Returns the value of the href attribute
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the {@link self} is not a hyperlink.
   *
   * @return string|null the value of the href attribute
   * @link http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function getHref(): ?string {
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
    $this->attributes()->setAttribute('target', $target);
    if ($this->getTarget() === '_blank') {
      $this->setRelationship('noopener noreferrer');
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
   * @return string|null the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function getTarget(): ?string {
    return $this->attributes()->getValue('target');
  }

  /**
   * Returns the relationship between the current document and the linked document
   *
   * **Notes:**
   *
   * * Only used if the `href` attribute is present.
   *
   * @return string|null the relationship between the current document and the linked document
   * @link  http://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function getRelationship(): ?string {
    return $this->attributes()->getValue('rel');
  }

  /**
   * Sets the relationship between the current document and the linked document
   *
   * **Notes:**
   *
   * * Only used if the href attribute is present.
   *
   * @param  string|null $rel optional relationship between the current document and the linked document
   * @return $this for a fluent interface
   * @link  http://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function setRelationship(string $rel = null) {
    $this->attributes()->setAttribute('rel', $rel);
    return $this;
  }

}
