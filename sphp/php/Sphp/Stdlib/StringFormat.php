<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class URLTemplate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class StringFormat {

  /**
   * @var string
   */
  private $template;

  /**
   * @var callback
   */
  private $filters;

  /**
   * Constructor
   * 
   * @param string $template
   * @param callback $filter
   * @throws InvalidArgumentException
   */
  public function __construct(string $template, ...$filter) {
    $this->template = $template;
    $this->filters = [];
    foreach ($filter as $index => $f) {
      $this->setFilter($index, $f);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->filters);
  }

  public function getTemplate(): string {
    return $this->template;
  }

  public function getFilters(): iterable {
    return $this->filters;
  }

  /**
   * 
   * @param  int $index
   * @param  callable $filter
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setFilter(int $index, $filter) {
    if (!is_callable($filter)) {
      throw new InvalidArgumentException("Filter at index ($index) is not callable");
    }
    $this->filters[$index] = $filter;
    return $this;
  }

  public function getFilter(int $index) {
    $filter = null;
    if (array_key_exists($index, $this->filters)) {
      $filter = $this->filters[$index];
    }
    return $filter;
  }

  public function hasFilters(): bool {
    return !empty($this->filters);
  }

  public function filterExists(int $index): bool {
    return array_key_exists($index, $this->filters);
  }

  /**
   * 
   * @param type $params
   * @return array
   * @throws RuntimeException
   */
  public function filterParams(...$params): array {
    $numParams = count($params);
    $numFilters = count($this->filters);
    if ($numParams > 0 && $numFilters > 0) {
      foreach ($this->getFilters() as $id => $filter) {
        if (array_key_exists($id, $params)) {
          $value = $filter($params[$id]);
          if (!is_scalar($value)) {
            throw new RuntimeException("Filter for parameter ($id) returns a non scalar value");
          }
          $params[$id] = $filter($params[$id]);
        }
      }
    }
    return $params;
  }

  /**
   * 
   * @param type $params
   * @return string
   * @throws RuntimeException
   */
  public function build(...$params): string {
    $params = $this->filterParams(...$params);
    $path = static::sprintf($this->getTemplate(), ...$params);
    return $path;
  }

  /**
   * 
   * @param  string $format
   * @param  mixed $params
   * @return string
   * @throws RuntimeException
   */
  public static function sprintf(string $format, ...$params): string {
    $errorLevel = error_reporting(0);
    $result = vsprintf($format, $params);
    error_reporting($errorLevel);
    if (!$result) {
      //print_r(error_get_last());
      $lastError = error_get_last();
      throw new RuntimeException($lastError['message'] . " when using format '$format'", $lastError['type']);
    }
    return $result;
  }

}
