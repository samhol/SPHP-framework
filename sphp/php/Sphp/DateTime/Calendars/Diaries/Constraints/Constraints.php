<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Constraints;

/**
 * Implements a collection of date Constraints
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Constraints implements DateConstraint {

  /**
   * @var Constraint[] 
   */
  private $dateIs = [];

  /**
   * @var Constraint[] 
   */
  private $dateIsNot = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->dateIs = [];
    $this->dateIsNot = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateIs, $this->dateIsNot);
  }

  public function isValidDate($date): bool {
    //$result = false;
    $is = false;
    $isNot = false;
    foreach ($this->dateIs as $constraint) {
      $is = $constraint->isValidDate($date);
      //echo "\nis: " . var_export($is, true) . "\n";
      if ($is === true) {
        break;
      }
    }
    if ($is) {
      foreach ($this->dateIsNot as $constraint) {
        $isNot = $constraint->isValidDate($date);
        //echo "\nisnot: " . var_export($isNot, true) . "\n";
        if ($isNot === true) {
          break;
        }
      }
    }
    return $is && !$isNot;
  }

  /**
   * Sets a rule to include dates
   * 
   * @param  DateConstraint $c
   * @return $this for a fluent interface
   */
  public function dateIs(DateConstraint $c) {
    $this->dateIs[] = $c;
    return $this;
  }

  /**
   * Sets a rule to exclude dates
   * 
   * @param  DateConstraint $c 
   * @return $this for a fluent interface
   */
  public function dateIsNot(DateConstraint $c) {
    $this->dateIsNot[] = $c;
    return $this;
  }

}
