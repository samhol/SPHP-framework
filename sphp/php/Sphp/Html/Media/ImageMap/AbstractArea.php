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
use Sphp\Html\Attributes\PatternAttribute;

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
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates(): array {
    $coordsString = $this->attributes()->getObject('coords');
    if($coordsString !== null) {
      return explode(',', $coordsString);
    }
    return [];
  }

  public function setAlt(string $alt = null) {
    $this->attributes()->setAttribute('alt', $alt);
    return $this;
  }

  public function getAlt(): ?string {
    return $this->attributes()->getValue('alt');
  }

}
