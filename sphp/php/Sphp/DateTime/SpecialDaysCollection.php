<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
