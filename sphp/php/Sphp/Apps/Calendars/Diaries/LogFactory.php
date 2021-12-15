<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;

use Sphp\DateTime\Constraints\DateConstraint;
use Sphp\DateTime\Constraints\Factory;

/**
 * The LogFactory class
 *
 * @method \Sphp\Apps\Calendars\Diaries\Log annual(array $dateParams, string $heading, ?string $description = null) Creates a new instance
 * @method \Sphp\Apps\Calendars\Diaries\Log anyOfDates(mixed $dateParams, string $heading, ?string $description = null) Creates a new instance
 * @method \Sphp\Apps\Calendars\Diaries\Log weekdays(int[] $dateParams, string $heading, ?string $description = null) Creates a new instance
 * @method \Sphp\Apps\Calendars\Diaries\Log monthly(int[], string $heading, ?string $description = null) Creates a new instance
 * @method \Sphp\Apps\Calendars\Diaries\Log inPeriod(array $dateParams, string $heading, ?string $description = null) Creates a new instance
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LogFactory {

  /**
   * @var string
   */
  private string $className;

  /**
   * 
   * @param string $className
   */
  public function __construct(string $className) {
    $this->className = $className;
  }

  public function getClassName(): string {
    return $this->className;
  }

  /**
   * 
   * @param  DateConstraint $constraint
   * @param  string $heading
   * @param  string|null $description
   * @return Log 
   */
  public function buildInstance(DateConstraint $constraint, string $heading, ?string $description = null): Log {
    $class = $this->className;
    return new $class($constraint, $heading, $description);
  }

  public function __call(string $name, array $arguments): Log {
    $constraints = array_shift($arguments);
    if (is_array($constraints)) {
      $constraint = Factory::instance()->$name(...$constraints);
    } else {
      $constraint = Factory::instance()->$name($constraints);
    }
    return $this->buildInstance($constraint, ...$arguments);
  }

}
