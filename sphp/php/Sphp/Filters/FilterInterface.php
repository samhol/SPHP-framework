<?php

/**
 * FilterInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

/**
 * Defines a data filter
 * 
 * **Important:** 
 * 
 * 1. All filter implementations should accept any type of input variable
 * 2. A {@link self} implementation should never throw an {@link \Exception} or 
 *    produce PHP errors or PHP warnings for any type of input data
 * 3. otherwise the implementation of the functionality is totally unrestricted
 * 4. because of the above rules these filters are **NOT** necessarily **SAFE**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FilterInterface {

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
