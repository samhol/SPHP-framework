<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\Date;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Trackers\Data\Users\DateData;
use Sphp\Html\Layout\Div;
use Sphp\Html\Tags;

/**
 * Class DayDataView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SimpleDateDataView extends AbstractContent {

  /**
   * @var DateData 
   */
  private $dateData;

  public function __construct(DateData $dateData) {
    $this->dateData = $dateData;
  }

  public function __destruct() {
    unset($this->dateData);
  }

  public function buildData(): Div {
    $cont = new Div();
    $cont->addCssClass('date-stats');
    $countNew = $this->dateData->getFirstVisits();
    if ($countNew > 0) {
      $cont->append(Tags::span('+' . $countNew)->addCssClass('number new-users'));
    }
    $cont->append(Tags::span($this->dateData->getVisits())->addCssClass('number total-users'));
    return $cont;
  }

  public function getHtml(): string {
    return $this->buildData()->getHtml();
  }

}
