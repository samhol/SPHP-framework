<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Defines SpecialDaysCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface SpecialDaysCollection extends \Traversable {

  public function merge(SpecialDays $days);

  public function add(SpecialDay $day);

  /**
   * 
   * @param SpecialDay $date
   * @return bool 
   */
  public function contains(SpecialDay $date): bool;

  /**
   * 
   * @param  Date $date
   * @return bool 
   */
  public function hasSpecialDays(Date $date): bool;

  /**
   * 
   * @param Date $date
   */
  public function get(Date $date): array;
}
