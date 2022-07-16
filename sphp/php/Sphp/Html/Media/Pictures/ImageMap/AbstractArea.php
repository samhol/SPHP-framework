<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures\ImageMap;

use Sphp\Html\EmptyTag;
use Sphp\Html\Attributes\PatternAttribute;

/**
 * Abstract area tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractArea extends EmptyTag implements Area {

  /**
   * Constructor
   * 
   * @param string $shape
   * @param string $pattern
   */
  public function __construct(string $shape, string $pattern = '/^(\d+(,\d+)*)?$/') {
    parent::__construct('area');
    $this->attributes()->setInstance(new PatternAttribute('coords', $pattern));
    $this->attributes()->protect('shape', $shape);
  }

  public function getShape(): string {
    return $this->attributes()->getValue('shape');
  }

  /**
   * Returns the coordinates of the area
   * 
   * @return int[] the coordinates of the area
   * @link   https://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates(): array {
    $coordsString = $this->getAttribute('coords');
    $out = [];
    if ($coordsString !== null) {
      foreach (explode(',', $coordsString) as $coord) {
        $out[] = (int) $coord;
      }
    }
    return $out;
  }

  /**
   * Sets the value of the href attribute (The URL of the link)
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * <code>$alt</code> is required if the <code>$href</code> is set
   *
   * @param  string|null $href the URL of the link
   * @param  string|null $alt Specifies an alternate text for the area. Required if the href attribute is present
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref(?string $href = null, ?string $alt = null) {
    $this->attributes()->setAttribute('href', $href);
    if ($href !== null && $alt === null) {
      $alt = $href;
    }
    $this->setAlt($alt);
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
    return $this->attributes()->getValue('href');
  }

  public function setAlt(?string $alt = null) {
    $this->attributes()->setAttribute('alt', $alt);
    return $this;
  }

  public function getAlt(): ?string {
    return $this->attributes()->getValue('alt');
  }

  public function setTarget(?string $target = null, bool $secureBlank = true) {
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
   * @link  https://www.w3schools.com/tags/att_a_rel.asp rel attribute
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
   * @link  https://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function setRelationship(?string $rel = null) {
    $this->attributes()->setAttribute('rel', $rel);
    return $this;
  }

}
