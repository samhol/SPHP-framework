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
use Sphp\Html\Lists\Ul; 

/**
 * Class DateDataDetailsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateDataDetailsView extends AbstractContent {

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
    $date = $this->dateData->getDate();
    $cont->appendH3($date->format('l jS \o\f F Y'));
    $cont->appendParagraph('Week number: ' . $date->format('W'));
    $cont->append($this->buildStatisticsList());
    return $cont;
  }

  private function buildStatisticsList(): Ul {
    $cont = new Ul();
    $cont->addCssClass('data-list');
    $cont->append('<strong>New visitors:</strong> ')
            ->append(Tags::span($this->dateData->getFirstVisits())
                    ->addCssClass('number'));
    $cont->append('<strong>Total visitors:</strong> ')
            ->append(Tags::span($this->dateData->getVisits())
                    ->addCssClass('number'));
    $cont->append('<strong>Page refreshes:</strong> ')
            ->append(Tags::span($this->dateData->getRefreshes())
                    ->addCssClass('number'));
    return $cont;
  }

  public function getHtml(): string {
    return $this->buildData()->getHtml();
  }

}
