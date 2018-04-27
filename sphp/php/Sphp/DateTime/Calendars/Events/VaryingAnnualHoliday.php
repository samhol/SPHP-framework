<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;

/**
 * Description of SequentialEvent
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VaryingAnnualHoliday extends AbstractHoliday {

  /**
   * @var string 
   */
  private $format;

  public function __construct(string $format, string $name) {
    parent::__construct($name);
    $this->format = $format;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    $year = $date->getYear();
    $check = Date::from(sprintf($this->format, $year));
    return $check->matchesWith($date);
  }

}
