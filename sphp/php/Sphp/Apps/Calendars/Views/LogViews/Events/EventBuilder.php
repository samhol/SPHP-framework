<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Events;

use Sphp\Html\AbstractContent;

/**
 * The EventBuilder class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EventBuilder extends AbstractContent {

  /**
   * Constructor
   * 
   * @param Date $viewedDate
   */
  public function __construct(Date $viewedDate = null) {
    //$this->birthdayView = new BirthdayView($viewedDate);
    //$this->holidayView = new HolidayView();
  }

  public function getHtml(): string {
    
  }

}
