<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\Tags;
use Sphp\Html\DateTime\TimeTag;
use Sphp\DateTime\Date;
/**
 * The DateStamp class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateStamp {

  public function create(Date $date) :TimeTag{
    $timeTag = new TimeTag($date, 'Y-m-d');
    $timeTag->addCssClass('sphp-date-stamp');
    $timeTag->append(Tags::span($date->format('M'))->addCssClass('month'));
    $timeTag->append(Tags::span($date->format('l'))->addCssClass('weekday'));
    $timeTag->append(Tags::span($date->format('jS'))->addCssClass('day'));
    $timeTag->append(Tags::span($date->getYear())->addCssClass('year'));
    return $timeTag;
  }

}
