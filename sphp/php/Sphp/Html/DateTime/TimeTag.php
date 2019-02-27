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
  private $format = self::DATE_TIME;

  /**
   * Constructor
   *
   * @param  mixed $dateTime the datetime object
   * @param  mixed $content optional content of the component
   * @param  string $format the format of the outputted date string
   */
  public function __construct($dateTime = null, $content = null, string $format = self::DATE_TIME) {
    parent::__construct('time', $content);
    $this->setDateTime($dateTime, $format);
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

  public function setDateTime($dateTime, string $format = self::DATE_TIME) {
    $this->setFormat($format);
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
    $dateTime = \Sphp\DateTime\DateTimes::dateTimeImmutable($dateTime);
    return (new TimeTag($dateTime, $dateTime->format('W')))->setFormat(TimeTag::Y_W);
  }

}
