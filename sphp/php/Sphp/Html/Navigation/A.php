<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML a tag
 *
 * If this component has an `href` attribute, then it represents a hyperlink
 * (a hypertext anchor). If the component has no `href` attribute, then the
 * component represents a placeholder for where a link might otherwise have
 * been placed, if it had been relevant.
 *
 * The `target`, `rel`, `media`, `hreflang`, and `type` attributes must be omitted if
 * the `href` attribute is not present.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class A extends ContainerTag implements Hyperlink {

  /**
   * Constructor
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href optional URL of the link
   * @param  string|null $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(?string $href = null, mixed $content = null, ?string $target = null) {
    parent::__construct('a', $content);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

  /**
   * Sets the value of the href attribute (The URL of the link)
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href the URL of the link
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref(?string $href) {
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
   * @link https://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function getHref(): ?string {
    return $this->attributes()->getStringValue('href');
  }

  public function setTarget(?string $target, bool $secureBlank = true) {
    $this->attributes()->setAttribute('target', $target);
    if ($this->getTarget() === '_blank' && $secureBlank) {
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
   * @link  https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function getTarget(): ?string {
    return $this->attributes()->getStringValue('target');
  }

  /**
   * Returns the relationship between the current document and the linked document
   *
   * **Notes:**
   *
   * * Only used if the `href` attribute is present.
   *
   * @return string|null the relationship between the current document and the linked document
   * @link  https://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function getRelationship(): ?string {
    return $this->attributes()->getStringValue('rel');
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
   * @link  https://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function setRelationship(string $rel = null) {
    $this->attributes()->setAttribute('rel', $rel);
    return $this;
  }

}
