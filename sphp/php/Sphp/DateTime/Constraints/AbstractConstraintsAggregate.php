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

use Sphp\Stdlib\Arrays;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Countable;

/**
 * Class AbstractConstraintsAggregate
 * 
 * @method \Sphp\DateTime\Constraints\Annual annual(int $month, int $day) adds a new instance
 * @method \Sphp\DateTime\Constraints\Between between(mixed $start = null, mixed $stop = null) adds a new instance
 * @method \Sphp\DateTime\Constraints\After after(mixed $date) adds a new instance
 * @method \Sphp\DateTime\Constraints\Before before(mixed $date) adds a new instance
 * @method \Sphp\DateTime\Constraints\AnyOfDates anyOfDates(mixed ...$date) adds a new instance
 * @method \Sphp\DateTime\Constraints\Weekdays weekdays(int... $weekday) adds a new instance
 * @method \Sphp\DateTime\Constraints\Monthly monthly(int... $day) adds a new instance
 * @method \Sphp\DateTime\Constraints\InPeriod inPeriod(int... $weekday) adds a new instance
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractConstraintsAggregate implements DateConstraint, IteratorAggregate, Countable {

  /**
   * @var DateConstraint[] 
   */
  private array $constraints;

  /**
   * Constructor
   *
   * @param DateConstraint ... $constraint
   */
  public function __construct(DateConstraint ... $constraint) {
    $this->constraints = $constraint;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->constraints);
  }

  /**
   * Clones the instance
   */
  public function __clone() {
    $this->constraints = Arrays::copy($this->constraints);
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->constraints);
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
    $constraint = Factory::instance()->$name(...$arguments);
    $this->addConstraint($constraint);
    return $this;
  }

  public function addConstraint(DateConstraint $constraint) {
    $this->constraints[] = $constraint;
    return $this;
  }

  public function addConstraints(DateConstraint ... $constraint) {
    $this->constraints = array_merge($this->constraints, $constraint);
    return $this;
  }

  public function count(): int {
    return count($this->constraints);
  }

  public function isEmpty(): bool {
    return empty($this->constraints);
  }

}
