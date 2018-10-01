<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Sphp\Exceptions\BadMethodCallException;

/**
 * A factory for variable filters
 * 
 * @method \Sphp\Filters\VariableFilter int(array $options = []) creates an integer validation filter instance
 * @method \Sphp\Filters\VariableFilter stríng(array $options = []) creates a string validation filter instance
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Filters {

  /**
   * @var int[] 
   */
  private static $filters;

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return VariableFilter
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): VariableFilter {
    if (self::$filters === null) {
      foreach (filter_list() as $filter) {
        $str = str_replace('_', ' ', $filter);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);
        $str = lcfirst($str);
        $id = filter_id($filter);
        if ($str !== $filter) {
          self::$filters[$str] = $id;
        }
        self::$filters[$filter] = $id;
      }
    }
    // print_r(self::$filters);
    if (array_key_exists($name, self::$filters)) {
      return new VariableFilter(self::$filters[$name]);
    }
    throw new BadMethodCallException("Filter '$name' does not exist");
  }

}
