<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars;

use Sphp\Html\Content;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\Html\Container;
use Sphp\Html\DateTime\Calendars\LogViews\LogViewBuilder;

/**
 * Implements an info modal for all events and logs of a calendar day
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateInfo implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var DiaryDate 
   */
  private $date;

  /**
   * @var Modal 
   */
  private $modal;

  /**
   * @var LogViewBuilder
   */
  private $logLayoutBuilder;

  /**
   * Constructor
   * 
   * @param DiaryDate $date
   * @param ComponentInterface|string $trigger
   */
  public function __construct(DiaryDate $date, $trigger) {
    $this->date = $date;
    $this->logLayoutBuilder = LogViewBuilder::instance();
    $this->modal = new Modal($trigger, $this->createPopup());
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->modal, $this->logLayoutBuilder);
  }

  public function createPopup(): Popup {
    $popup = new Popup();
    $popup->addCssClass('sphp-date-info');
    $date = $this->date->format('l F jS Y');
    $popup->append("<h2>$date</h2>");
    $popup->append($this->logLayoutBuilder->build($this->date));
    return $popup;
  }

  public function createHolidayNotes(): Container {
    $ul = new Container();
    if (count($this->date->getHolidays()) > 0) {
      $ul->appendMd("**HOLIDAYS:**");
      foreach ($this->date as $log) {
        if ($log instanceof BirthDay) {
          $ul->appendMd($log->toString($this->date->getYear()));
        } else {
          $ul->appendMd($log->toString());
        }
      }
    }
    return $ul;
  }

  /**
   * 
   * @return Modal
   */
  public function create(): Modal {
    return $this->modal;
  }

  public function getHtml(): string {
    return $this->modal->getHtml();
  }

}
