<?php

/**
 * AbstractArea.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag;
use Sphp\Html\Navigation\HyperlinkTrait;
use Sphp\Html\Attributes\SequenceAttribute;

/**
 * Implements an HTML &lt;area&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractArea extends EmptyTag implements Area {

  use HyperlinkTrait;

  /**
   * Constructs a new instance
   * 
   * @param string $shape
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct(string $shape, string $href = null, string $alt = null) {
    parent::__construct('area');
    $this->attributes()->setInstance(new SequenceAttribute('coords'));
    $this->attributes()->protect('shape', $shape);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($alt !== null) {
      $this->setHref($href);
    }
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_shape.asp shape attribute
   */
  public function getShape(): string {
    return $this->getAttribute('shape');
  }

  /**
   * Returns the coordinates of the area
   * 
   * @return SequenceAttribute the coordinates of the area
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates(): SequenceAttribute {
    return $this->attributes()->getObject('coords');
  }

  /**
   * Sets the relationship between the current document and the linked document
   * 
   * @param  string $rel the value of the rel attribute
   * @return Area for PHP Method Chaining
   * @link   http://www.w3schools.com/TAGS/att_area_rel.asp rel attribute
   */
  public function setRelationship($rel) {
    $this->attributes()->set('rel', $rel);
    return $this;
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getRelationship() {
    return $this->getAttribute('rel');
  }

  /**
   * Specifies the alternate text for the area, if the image cannot be displayed
   *
   * **Definition and Usage:**
   *
   *  The alt attribute specifies an alternate text for an area, if the image 
   * cannot be displayed. The `alt` attribute provides alternative information for 
   * an image if a user for some reason cannot view it (because of slow 
   * connection, an error in the src attribute, or if the user uses a screen 
   * reader). 
   * 
   * The `alt` attribute is required if the `href` attribute is present.
   *
   * @param  string $alt the alternate text for an image
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function setAlt($alt) {
    $this->attributes()->set('alt', $alt);
    return $this;
  }

  /**
   * Returns the alternate text for the area, if the image cannot be displayed
   * 
   * **Definition and Usage:**
   *
   *  The alt attribute specifies an alternate text for an area, if the image 
   * cannot be displayed. The `alt` attribute provides alternative information for 
   * an image if a user for some reason cannot view it (because of slow 
   * connection, an error in the src attribute, or if the user uses a screen 
   * reader). 
   * 
   * The `alt` attribute is required if the `href` attribute is present.
   *
   * @return string the value of the alt attribute
   * @link  http://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function getAlt() {
    return $this->attributes()->getValue('alt');
  }

}
