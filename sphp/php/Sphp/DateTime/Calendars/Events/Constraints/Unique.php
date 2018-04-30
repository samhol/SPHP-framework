<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\DateInterface;

/**
 * Description of Unique
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Unique implements Constraint {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param DateInterface $date the date of the holiday
   */
  public function __construct(DateInterface $date) {
    $this->date = $date;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
  }

  /**
   * Returns the valid date
   * 
   * @return DateInterface the date of the holiday
   */
  public function getDate(): DateInterface {
    return $this->date;
  }

  public function isValid(DateInterface $date): bool {
    return $this->date->matchesWith($date);
  }

}
