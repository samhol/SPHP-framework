<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Text;

use Sphp\Html\ContainerTag;
use Sphp\DateTime\DateTime;
use DateTimeInterface;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\DateTime\Duration;
use Sphp\DateTime\Interval;

/**
 * Implementation of an HTML time tag
 *
 * This implements a human-readable date/time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Time extends ContainerTag {

  /**
   * Constructor
   *
   * @param  mixed $content optional content of the component
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(mixed $content = null) {
    parent::__construct('time', $content);
  }

  /**
   * Sets the value of the datetime attribute
   * 
   * @param  DateTime|DateTimeInterface|string|null $dateTime
   * @param  string $format
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if formatting fails
   * @link   https://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function setDateTime(DateTime|DateTimeInterface|string $dateTime = null, string $format = 'c') {
    if (is_string($dateTime)) {
      $dateTime = ImmutableDateTime::from($dateTime);
    }
    if (!is_null($dateTime)) {
      $this->attributes()->setAttribute('datetime', $dateTime->format($format));
    } else {
      $this->removeAttribute('datetime');
    }
    return $this;
  }

  /**
   * Sets the value of the datetime attribute
   * 
   * @param  Interval|\DateInterval|string|null $interval
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if formatting fails
   * @link   https://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function useDuration(Interval|\DateInterval|string $interval = null) {
    if (!is_null($interval)) {
      $interval = Interval::create($interval);
      $this->attributes()->setAttribute('datetime', (string) $interval);
    } else {
      $this->removeAttribute('datetime');
    }
    return $this;
  }

}
