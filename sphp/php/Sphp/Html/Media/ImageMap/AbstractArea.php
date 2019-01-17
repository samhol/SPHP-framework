<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag;
use Sphp\Html\Navigation\HyperlinkTrait;

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
   * Constructor
   * 
   * @param string $shape
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct(string $shape, string $href = null, string $alt = null) {
    parent::__construct('area');
    $this->attributes()->setInstance(new CoordinateAttribute('coords'));
    $this->attributes()->protect('shape', $shape);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($alt !== null) {
      $this->setAlt($alt);
    }
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_shape.asp shape attribute
   */
  public function getShape(): string {
    return $this->attributes()->getValue('shape');
  }

  /**
   * Returns the coordinates of the area
   * 
   * @return CoordinateAttribute the coordinates of the area
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates(): CoordinateAttribute {
    return $this->attributes()->getObject('coords');
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
    $this->attributes()->setAttribute('alt', $alt);
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
