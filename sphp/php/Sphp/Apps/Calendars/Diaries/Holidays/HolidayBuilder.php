<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\Apps\Calendars\Diaries\LogFactory;
use Sphp\DateTime\ImmutableDate;

/**
 * The HolidayBuilder class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayBuilder extends LogFactory {

  public function __construct() {
    parent::__construct(Holiday::class);
  }

  /**
   * Creates a new birthday instance
   * 
   * @param  mixed $dob date of birth
   * @param  string $name
   * @param  mixed $dod date of death (defaults to `null` which means alive)
   * @return BirthDay new instance
   */
  public function birthday($dob, string $name, $dod = null): BirthDay {
    if ($dod !== null) {
      $dod = ImmutableDate::from($dod);
      //   echo "<br>$name dod:" . $dod->format('Y-m-d');
    }
    $dobObj = ImmutableDate::from($dob);
    //echo "<br>$name dob:" . $dobObj->format('Y-m-d');
    return new BirthDay($dobObj, $name, $dod);
  }

}
