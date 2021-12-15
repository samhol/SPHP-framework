<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Holidays;

use Sphp\Html\Tags;
use Sphp\Apps\Calendars\Diaries\Log;

/**
 * Implements a holiday view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LogView {

  /**
   * Implements function call
   * 
   * @param  Log $holiday
   * @return string
   */
  public function __invoke(Log $holiday): string {
    return $this->build($holiday);
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @param  Log $holiday
   * @return string
   */
  public function build(Log $holiday): string {
    $strong = Tags::span($holiday->getName())->addCssClass('strong');
    $description = Tags::span(' ' . $holiday->getDescription());

    return $strong . $description;
  }

}
