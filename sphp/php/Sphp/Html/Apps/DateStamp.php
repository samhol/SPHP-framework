<?php

/**
 * DateStamp.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\TimeTagInterface;
use Sphp\Html\AbstractComponent;
use DateTime;

/**
 * Class models a HTML based stamp-element that describes a {@link DateTime} object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DateStamp extends AbstractComponent implements TimeTagInterface {

  /**
   * the datetime object
   *
   * @var DateTime 
   */
  private $dateTime;

  /**
   * Constructs a new instance
   *
   * @param  DateTime $datetime the datetime object
   */
  public function __construct(DateTime $datetime) {
    parent::__construct("time");
    $this->cssClasses()->lock("date-icon");
    $this->setDatetime($datetime);
  }

  /**
   * Sets the datetime object
   * 
   * **Important:** Sets also the `datetime` attribute
   *
   * @param  DateTime $dateTime the datetime object
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function setDateTime(DateTime $dateTime) {
    $this->attrs()->set("datetime", $dateTime->format("Y-m-d H:i:s"));
    $this->dateTime = $dateTime;
    return $this;
  }

  public function getDateTime() {
    return $this->dateTime;
  }

  public function contentToString() {
    $output = "<em>" . $this->dateTime->format("l") . "</em>";
    $output .= "<strong>" . $this->dateTime->format("F") . "</strong>";
    $output .= "<span>" . $this->dateTime->format("j") . "</span>";
    return $output;
  }

}
