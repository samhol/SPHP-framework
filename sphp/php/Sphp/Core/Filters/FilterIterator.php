<?php

/**
 * FilterIterator.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

use IteratorIterator;
use Traversable;
use ArrayIterator;

/**
 * Class FilterIterator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-27
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FilterIterator extends IteratorIterator {

  /**
   *
   * @var callable
   */
  private $filter;

  /**
   * 
   * @param array|Traversable $iterator
   * @param callable $filter
   */
  public function __construct($iterator, callable $filter = null) {
    if (is_array($iterator)) {
      $iterator = new ArrayIterator($iterator);
    }
    parent::__construct($iterator);
    $this->setFilter($filter);
  }

  /**
   * 
   * @param  callable $filter
   * @return self for PHP Method Chaining
   */
  public function setFilter(callable $filter) {
    $this->filter = $filter;
    return $this;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    if ($this->filter !== null) {
      $filter = $this->filter;
      return $filter(parent::current());
    } else {
      return parent::current();
    }
  }

}
