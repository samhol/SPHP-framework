<?php

/**
 * FilterAggregate.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

use IteratorAggregate;
use ArrayIterator;

/**
 * An aggregate of filters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Constructs a new instance
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
   * @return self for PHP Method Chaining
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
