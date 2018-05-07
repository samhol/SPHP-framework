<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use IteratorAggregate;
use ArrayIterator;

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
   * @param callable|callable[] $filters optional filters to add
   */
  public function __construct($filters = null) {
    if ($filters !== null) {
      foreach (is_array($filters) ? $filters : [$filters] as $filter) {
        $this->addFilter($filter);
      }
    }
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->filters);
  }

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  public function filter($value) {
    foreach ($this->filters as $filter) {
      $value = $filter($value);
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
   * @return ArrayIterator iterator over filters
   */
  public function getIterator() {
    return new ArrayIterator($this->filters);
  }

}
