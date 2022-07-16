<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use IteratorAggregate;
use ArrayIterator;
use Traversable;

/**
 * An aggregate of filters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FilterAggregate extends AbstractFilter implements IteratorAggregate {

  /**
   * the filter container
   *
   * @var callable[] 
   */
  private $filters = [];

  /**
   * Constructor
   * 
   * @param callable ... $filters optional filters to add
   */
  public function __construct(...$filters) {
    foreach ($filters as $filter) {
      $this->addFilter($filter);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->filters);
  }

  /**
   * Executes the filter when the filter object is called as a function
   * 
   * @param  mixed $variable the data to filter
   * @return mixed the filtered value
   */
  public function __invoke(mixed $value, mixed ... $param): mixed {
    return $this->filter($value, ...$param);
  }

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  public function filter(mixed $value, mixed ... $param): mixed {
    foreach ($this->filters as $filter) {
      $value = $filter($value, ...$param);
    }
    return $value;
  }

  /**
   * Adds a filter to the aggregate
   * 
   * @param  callable $filter a filter to add
   * @return $this for a fluent interface
   */
  public function addFilter(callable $filter) {
    $this->filters[] = $filter;
    return $this;
  }

  /**
   * Returns the iterator
   * 
   * @return Traversable<Filter> iterator over filters
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->filters);
  }

}
