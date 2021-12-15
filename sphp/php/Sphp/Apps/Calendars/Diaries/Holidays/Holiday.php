<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\Apps\Calendars\Diaries\AbstractCalendarEntry;
use Sphp\DateTime\Constraints\DateConstraint;

/**
 * Implements a holiday log object for a Diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Holiday extends AbstractCalendarEntry implements HolidayInterface {

  private string $name;
  private ?string $description;
  private bool $national = false;
  private ?string $flagDay = null;

  /**
   * Constructor
   * 
   * @param DateConstraint $constraint
   * @param string $name
   * @param string|nll $description
   */
  public function __construct(DateConstraint $constraint, string $name, ?string $description = null) {
    parent::__construct($constraint);
    $this->setName($name)->setDescription($description);
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

  public function getDescription(): ?string {
    return $this->description;
  }

  public function setDescription(?string $description) {
    $this->description = $description;
    return $this;
  }

  /**
   * 
   * @param  string|null $country
   * @return $this for a fluent interface
   */
  public function setFlagDay(?string $country = null) {
    $this->flagDay = $country;
    return $this;
  }

  public function isFlagDay(): bool {
    return is_string($this->flagDay);
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
