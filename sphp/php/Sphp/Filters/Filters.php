<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Description of Filters
 *
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

  public static function __callStatic($name, $arguments) {
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
     print_r(self::$filters);
    if (array_key_exists($name, self::$filters)) {

      return new VariableFilter(self::$filters[$name]);
    }
    throw new \Sphp\Exceptions\BadMethodCallException($name);
  }

}
