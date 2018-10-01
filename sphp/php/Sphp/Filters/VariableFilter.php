<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Filters a variable with a specified filter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/filter.filters.php filter_var
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VariableFilter extends AbstractFilter {

  /**
   * @var int 
   */
  private $filter;

  /**
   * @var DataObject
   */
  private $opts;

  /**
   * Constructor
   * 
   * @param int $filter
   * @param mixed[] $options
   * @link  http://php.net/manual/en/filter.filters.php filter_var
   * @link  http://php.net/manual/en/filter.filters.php Types of filters
   */
  public function __construct(int $filter, $options = []) {
    $this->filter = $filter;
    $this->opts = new DataObject();
  }

  public function __get(string $name): DataObject {
    if ($name === 'options') {
      return $this->opts->options;
    }
    if ($name === 'flags') {
      return $this->opts->flags;
    }
    throw new InvalidArgumentException("Invalid parameter name '$name'");
  }

  public function __set($name, $value) {
    if ($name === 'flags') {
      return $this->opts->flags = $value;
    }
    throw new InvalidArgumentException("Cannot se parameter '$name'");
  }

  public function getFilter(): int {
    return $this->filter;
  }

  public function options(): DataObject {
    return $this->opts;
  }

  /**
   * 
   * @return int
   */
  public function getFlags() {
    return $this->flags;
  }

  /**
   * Sets the option name value pair
   * 
   * @param  string $optName option name
   * @param  mixed $value
   * @return $this for a fluent interface
   */
  protected function setOption($optName, $value) {
    $this->opts['options'][$optName] = $value;
    return $this;
  }

  public function filter($variable) {
    //var_dump($this->opts->toArray());
    if ($this->filter === FILTER_VALIDATE_INT && is_numeric($variable)) {
      echo "original : $variable\n";
      $variable = intval(round($variable));
    }
    return filter_var($variable, $this->filter, $this->opts->toArray());
  }

}
