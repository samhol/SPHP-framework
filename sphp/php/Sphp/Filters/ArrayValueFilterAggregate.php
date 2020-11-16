<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Class ArrayValueFilterAggregate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ArrayValueFilterAggregate implements ArrayFilter {

  private $filters = [];
  private $replace = true;

  public function __construct(array $filters = []) {
    $this->setFilters($filters);
  }

  public function __destruct() {
    unset($this->filters);
  }

  public function replaceMatches(bool $replace) {
    $this->replace = $replace;
    return $this;
  }

  /**
   * 
   * @param  string|int $key
   * @param  string|Callable $filter
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setFilterForKey($key, $filter) {
    if (!is_scalar($key)) {
      throw new InvalidArgumentException("Invalid type for changeable key given");
    }
    if (!is_callable($filter)) {
      throw new InvalidArgumentException("Invalid type for filter");
    }
    $this->filters[$key] = $filter;
    return $this;
  }

  /**
   * 
   * @param  array $filters
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setFilters(array $filters) {
    foreach ($filters as $key => $filter) {
      $this->setFilterForKey($key, $filter);
    }
    return $this;
  }

  public function __invoke(array $array): array {
    return $this->filter($array);
  }

  public function filter(array $array): array {
    $result = $array;
    foreach ($this->filters as $key => $filter) {
      if (array_key_exists($key, $array)) {
        $result[$key] = $filter($array[$key]);
      }
    }
    return $result;
  }

}
