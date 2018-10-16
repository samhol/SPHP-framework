<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Navigation\HyperlinkInterface;

/**
 * Defines the basic properties of an HTML &lt;area&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Area extends HyperlinkInterface {

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_shape.asp shape attribute
   */
  public function getShape(): string;

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
  public function setAlt($alt);

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
  public function getAlt();
}
