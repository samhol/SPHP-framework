<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use IteratorIterator;
use Traversable;
use ArrayIterator;

/**
 * Class FilterIterator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FilterIterator extends IteratorIterator {

  /**
   * @var callable
   */
  private $filter;

  /**
   * Constructor
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
   * @return $this for a fluent interface
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
