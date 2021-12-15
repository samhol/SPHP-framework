<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Exceptions\{
  BadMethodCallException,
  InvalidArgumentException
};
use Sphp\DateTime\ImmutableDate;

/**
 * Class Factory
 * 
 * @method \Sphp\DateTime\Constraints\Annual annual(int $month, int $day) Creates a new instance
 * @method \Sphp\DateTime\Constraints\AnyOfDates anyOfDates(mixed ...$date) Creates a new instance
 * @method \Sphp\DateTime\Constraints\Weekdays weekdays(int... $weekday) Creates a new instance
 * @method \Sphp\DateTime\Constraints\Monthly monthly(int... $day) Creates a new instance
 * @method \Sphp\DateTime\Constraints\InPeriod inPeriod(int... $weekday) Creates a new instance
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Factory {

  /**
   * @var atring[]
   */
  private $constraintsNameMap = [
      'annual' => Annual::class,
      'varyingannual' => VaryingAnnual::class,
      'after' => After::class,
      'anyofdates' => AnyOfDates::class,
      'anyOf' => AnyOf::class,
      'weekly' => Weekdays::class,
      'weekdays' => Weekdays::class,
      'monthly' => Monthly::class,
      'inperiod' => InPeriod::class,
      'date' => Exactly::class,
  ];

  public function create(string $name, array $arguments): DateConstraint {
    if (!array_key_exists($name, $this->constraintsNameMap)) {
      throw new InvalidArgumentException("Method '$name' does not exist");
    }
    try {
      $reflector = new \ReflectionClass($this->constraintsNameMap[$name]);
      $constraint = $reflector->newInstanceArgs($arguments);
    } catch (\Throwable $ex) {
      throw new InvalidArgumentException("Invalid arguments used for '$name' call", $ex->getCode(), $ex);
    }
    return $constraint;
  }

  /**
   * Magic `call` method invoking inaccessible methods in an object context
   * 
   * @param  string $name method name
   * @param  array $arguments
   * @return DateConstraint
   * @throws BadMethodCallException if the method does not exist
   * @throws InvalidArgumentException if the method call has invalid arguments
   */
  public function __call(string $name, array $arguments): DateConstraint {
    $lcase = strtolower($name);
    if (!array_key_exists($lcase, $this->constraintsNameMap)) {
      throw new BadMethodCallException("Method '$name' does not exist");
    }
    return $this->create($lcase, $arguments);
  }

  /**
   * Creates  between dates constraint
   * 
   * @param  mixed $start
   * @param  mixed $stop
   * @return Between new instance
   * @throws InvalidArgumentException if the start or the end date cannot be parsed
   */
  public function between($start, $stop): Between {
    try {
      return new Between(ImmutableDate::from($start), ImmutableDate::from($stop));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Valid dates cannot be parsed for between constraint', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new After date constraint
   *
   * @param  mixed $date
   * @return After new instance
   * @throws InvalidArgumentException if the date cannot be parsed
   */
  public function after($date): After {

    try {
      return new After(ImmutableDate::from($date));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Valid date cannot be parsed for constraint', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new Before date constraint
   *
   * @param  mixed $date
   * @return Before new instance
   * @throws InvalidArgumentException if the date cannot be parsed
   */
  public function before($date): Before {
    try {
      return new Before(ImmutableDate::from($date));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Valid date cannot be parsed for constraint', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new unique date constraint
   *    * 
   * @param  mixed $date 
   * @return Exactly new instance
   * @throws InvalidArgumentException if the start or the end date cannot be parsed
   */
  public function unique($date): Exactly {
    try {
      return new Exactly(ImmutableDate::from($date));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Valid date cannot be parsed for unique constraint', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new unique date constraint
   *    * 
   * @param  mixed $date 
   * @return Exactly new instance
   * @throws InvalidArgumentException if the date cannot be parsed
   */
  public function date($date): Exactly {
    try {
      return new Exactly(ImmutableDate::from($date));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Valid date cannot be parsed for unique constraint', $ex->getCode(), $ex);
    }
  }

  /**
   * @var Factory
   */
  private static $instance;

  /**
   * 
   * @return Factory
   */
  public static function instance(): Factory {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

}
