<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\Calendars\Diaries\AbstractLog;
use Sphp\DateTime\Constraints\DateConstraint;

/**
 * Implements a holiday log object for a Diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Holiday extends AbstractLog implements HolidayInterface {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $description;

  /**
   * @var bool 
   */
  private $national = false;

  /**
   * @var string 
   */
  private $flagDay = false;

  /**
   * Constructor
   * 
   * @param DateConstraint $constraint
   * @param string $name
   * @param string $description
   */
  public function __construct(DateConstraint $constraint, string $name, string $description = null) {
    parent::__construct($constraint);
    $this->setName($name)->setDescription("$description");
  }

  public function __toString(): string {
    $output = $this->getName();
    $attrs = [];
    if ($this->isNationalHoliday()) {
      $attrs[] = 'national holiday';
    }
    if ($this->isFlagDay()) {
      $attrs[] = 'flagday';
    }
    if (!empty($attrs)) {
      $output .= ': ' . implode(', ', $attrs);
    }
    return $output;
  }

  public function getName(): string {
    return $this->name;
  }

  /**
   * Sets the name of the log
   * 
   * @param  string $name the name of the log
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function setDescription(string $description = null) {
    $this->description = $description;
    return $this;
  }

  /**
   * 
   * @param  string $country
   * @return $this for a fluent interface
   */
  public function setFlagDay(string $country = null) {
    $this->flagDay = $country;
    return $this;
  }

  public function isFlagDay(): bool {
    return $this->flagDay !== false;
  }

  public function isNationalHoliday(): bool {
    return $this->national;
  }

  /**
   * 
   * @param  bool $national
   * @return $this for a fluent interface
   */
  public function setNationalHoliday(bool $national = true) {
    $this->national = $national;
    return $this;
  }

}
