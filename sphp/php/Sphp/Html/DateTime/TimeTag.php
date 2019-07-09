<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime;

use DateTimeInterface;
use Sphp\DateTime\DateTime;
use Sphp\Html\ContainerTag;
use Sphp\DateTime\DateTimes;

/**
 * Implements an HTML &lt;time&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class TimeTag extends ContainerTag implements TimeTagInterface {

  /**
   * the datetime object
   *
   * @var DateTime 
   */
  private $dateTime;

  /**
   * @var string
   */
  private $format;

  /**
   * Constructor
   *
   * @param  mixed $dateTime the datetime object
   * @param  string $format the format of the outputted date string
   * @param  mixed $content optional content of the components
   */
  public function __construct($dateTime = null, string $format = 'c', $content = null) {
    parent::__construct('time', $content);
    $this->setFormat($format);
    $this->setDateTime($dateTime);
  }

  public function __destruct() {
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
  }

  public function setFormat(string $format = self::DATE_TIME) {
    $this->format = $format;
    return $this;
  }

  public function getFormat(): string {
    return $this->format;
  }

  public function setDateTime($dateTime) {
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateTime) {
      $dateTime = new DateTime($dateTime);
    }
    $this->dateTime = $dateTime;
    $this->attributes()->setAttribute('datetime', $this->dateTime->format($this->getFormat()));
    return $this;
  }

  /**
   * Creates a &lt;time&gt; tag object showing week number
   * 
   * @param  mixed $dateTime
   * @return TimeTag new instance
   */
  public static function weekNumber($dateTime = null): TimeTag {
    if ($dateTime === null) {
      $dateTime = DateTimes::dateTimeImmutable($dateTime);
    }
    return (new TimeTag($dateTime, 'Y-\WW', $dateTime->format('W')));
  }

}
