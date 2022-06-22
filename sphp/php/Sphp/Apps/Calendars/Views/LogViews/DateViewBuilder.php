<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews;

use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Html\Layout\Div;

/**
 * The BasicDateLogs class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateViewBuilder {

  /**
   * Returns a HTML object containing log view for a given day
   * 
   * @param  DiaryDate $date
   * @return Div containing log view for a given day
   */
  public function build(DiaryDate $date): Div {
    $day = $date->getDate();
    $dayNumBlock = new Div($day->format('j') . '<div>+2 <i class="fas fa-running"></i></div>');
    $dayNumBlock->setAttribute('data-date', $day->format('Y-m-d'));
    if ($day->isCurrentDate()) {
      $dayNumBlock->addCssClass('today');
    }
    if ($day->getMonth() === 1) {
      $dayNumBlock->addCssClass('current-month');
    } else {
      $dayNumBlock->addCssClass('not-current-month');
    }
    if ($date->isFlagDay()) {
      $dayNumBlock->append(new Div(ViewFactory::flag('finland')));
    }
    return $dayNumBlock;
  }

}
