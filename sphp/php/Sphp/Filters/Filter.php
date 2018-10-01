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
 * Defines a data filter
 * 
 * **Important:** 
 * 
 * 1. All filter implementations should accept any type of input variable
 * 2. An implementation should never throw an exception or produce PHP errors or 
 *    PHP warnings for any type of input data
 * 3. otherwise the implementation of the functionality is totally unrestricted
 * 4. because of the above rules these filters are **NOT** necessarily **SAFE**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Filter {

  /**
   * Executes the filter for the given data
   * 
   * @param  mixed $variable the data to filter
   * @return mixed the filtered value
   */
  public function filter($variable);

  /**
   * Executes the filter when the filter object is called as a function
   * 
   * @param  mixed $variable the data to filter
   * @return mixed the filtered value
   */
  public function __invoke($variable);
}
