<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Content;
use DateTimeInterface;
use Sphp\Html\Div;

/**
 * Description of WeekDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeekNumberView implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var DateTimeInterface
   */
  private $date;

  /**
   * @var Div
   */
  private $container;

  public function __construct(DateTimeInterface $date) {
    $this->date = $date;
    $this->container = new Div();
    $this->container->attributes()->classes()->protect('sphp', 'week-number');
  }

  protected function buildDate() {
    $this->container->append($this->date->format('W'));
    $this->container->setAttribute('title', 'Week ' . $this->date->format('W') . '.');
    return $this;
  }

  public function getHtml(): string {
    $this->buildDate();
    return $this->container->getHtml();
  }

}
