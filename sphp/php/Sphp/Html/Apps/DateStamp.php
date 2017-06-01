<?php

/**
 * DateStamp.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\TimeTagInterface;
use Sphp\Html\AbstractComponent;
use DateTimeInterface;
use DateTimeImmutable;

/**
 * Implements a HTML based stamp-element that describes a {@link DateTimeInterface} object
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
   * @var DateTimeInterface 
   */
  private $dateTime;

  /**
   * Constructs a new instance
   *
   * @param  DateTimeInterface $datetime optional datetime object (defaults to current date and time)
   */
  public function __construct(DateTimeInterface $datetime = null) {
    parent::__construct('time');
    $this->cssClasses()->lock('date-icon');
    if ($datetime === null) {
      $datetime = new DateTimeImmutable();
    }
    $this->setDatetime($datetime);
  }

  public function setDateTime(DateTimeInterface $dateTime) {
    $this->attrs()->set('datetime', $dateTime->format('Y-m-d H:i:s'));
    $this->dateTime = $dateTime;
    return $this;
  }

  public function getDateTime() {
    return $this->dateTime;
  }

  public function contentToString(): string {
    $output = '<em>' . $this->dateTime->format('l') . '</em>';
    $output .= '<strong>' . $this->dateTime->format('F') . '</strong>';
    $output .= '<span>' . $this->dateTime->format('j') . '</span>';
    return $output;
  }

}
