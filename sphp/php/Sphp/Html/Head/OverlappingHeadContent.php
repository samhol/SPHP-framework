<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

/**
 * Defines OverlappingHeadContent
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface OverlappingHeadContent extends HeadContent {

  /**
   * Checks if this meta data object has overlapping meta data with the given one 
   * 
   * @param  HeadContent $other
   * @return boolean true if the meta data object given is overlapping; false otherwise
   */
  public function overlapsWith(HeadContent $other): bool;
}
