<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Iterator;
use Sphp\DateTime\DateInterface;

/**
 * Description of Constraints
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Constraints implements Constraint {

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
    $result = false;
    foreach ($this->dateIs as $constraint) {
      $result = $constraint->isValidDate($date);
      if ($result === true) {
        break;
      }
    }
    foreach ($this->dateIsNot as $constraint) {
      $result = !$constraint->isValidDate($date);
      if ($result === true) {
        break;
      }
    }
    return $result;
  }

  /**
   * 
   * @param  Constraint $c
   * @return $this for a fluent interface
   */
  public function dateIs(Constraint $c) {
    $this->dateIs[] = $c;
    return $this;
  }

  /**
   * 
   * @param  Constraint $c
   * @return $this for a fluent interface
   */
  public function dateIsNot(Constraint $c) {
    $this->dateIsNot[] = $c;
    return $this;
  }

}
