<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use DateTimeInterface;
use DateTimeImmutable;

/**
 * Implements an HTML &lt;time&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimeTag extends ContainerTag implements TimeTagInterface, AjaxLoader {

  use AjaxLoaderTrait;

  /**
   * the datetime object
   *
   * @var DateTime 
   */
  private $dateTime;

  /**
   * Constructs a new instance
   *
   * @param  DateTimeInterface|null $dateTime the datetime object
   * @param  mixed $content optional content of the component
   */
  public function __construct(DateTimeInterface $dateTime = null, $content = null) {
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

  public function setDateTime(DateTimeInterface $dateTime) {
    $this->attributes()->set('datetime', (string) $dateTime->format('Y-m-d H:i:s'));
    $this->dateTime = $dateTime;
    return $this;
  }

  public function getDateTime(): DateTimeInterface {
    return $this->dateTime;
  }

}
