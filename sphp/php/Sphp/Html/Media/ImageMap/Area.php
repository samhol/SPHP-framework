<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Defines the basic properties of an HTML &lt;area tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Area extends Hyperlink {

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   https://www.w3schools.com/TAGS/att_area_shape.asp shape attribute
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
   * @param  string|null $alt the alternate text for an image
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function setAlt(string $alt = null);

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
   * @return string|null the value of the alt attribute
   * @link  https://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function getAlt(): ?string;
}
