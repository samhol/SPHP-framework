<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $this->cssClasses()->protect('date-icon');
    if ($datetime === null) {
      $datetime = new DateTimeImmutable();
    }
    $this->setDatetime($datetime);
  }

  public function setDateTime(DateTimeInterface $dateTime) {
    $this->attributes()->set('datetime', $dateTime->format('Y-m-d H:i:s'));
    $this->dateTime = $dateTime;
    return $this;
  }

  public function getDateTime(): DateTimeInterface {
    return $this->dateTime;
  }

  public function contentToString(): string {
    $output = '<em>' . $this->dateTime->format('l') . '</em>';
    $output .= '<strong>' . $this->dateTime->format('F') . '</strong>';
    $output .= '<span>' . $this->dateTime->format('j') . '</span>';
    return $output;
  }

}
