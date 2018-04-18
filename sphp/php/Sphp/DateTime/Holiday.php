<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Description of Holiday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holiday {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var string 
   */
  private $name;

  /**
   * 
   * 
   * @param Date $date
   * @param string $name
   */
  public function __construct(Date $date, string $name) {
    $this->date = $date;
    $this->name = $name;
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function equals($date): bool {
    return $this->date->equals($date);
  }

  public function __toString(): string {
    return $this->name;
  }

}
