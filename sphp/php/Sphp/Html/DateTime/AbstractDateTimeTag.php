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
use DateTimeImmutable;
use Sphp\Html\ContainerTag;

/**
 * Abstract implementation of an HTML &lt;time&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @link    https://github.com/samhol/SPHP-framework for the source repository
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractDateTimeTag extends ContainerTag implements TimeTagInterface {

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
   * Constructs a new instance
   *
   * @param  mixed $dateTime the datetime object
   * @param  mixed $content optional content of the component
   */
  public function __construct($dateTime = null, $content = null) {
    parent::__construct('time', $content);
    if ($dateTime !== null) {
      $this->setDateTime($dateTime);
    }
    if ($dateTime === null) {
      $dateTime = new DateTimeImmutable();
    }
  }

  public function __destruct() {
    unset($this->dateTime);
    parent::__destruct();
  }

  public function __clone() {
    $this->dateTime = clone $this->dateTime;
    parent::__clone();
  }

  public function setFormat(string $format = self::DATE_TIME) {
    $this->format = $format;
    return $this;
  }

  public function setDateTime($dateTime) {
    if (!$dateTime instanceof DateTimeInterface && !$dateTime instanceof DateTime) {
      $dateTime = new DateTime($dateTime);
    }
    $this->attributes()->set('datetime', $dateTime->format($this->format));
    return $this;
  }

}
