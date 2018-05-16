<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

/**
 * Defines a string converter
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface StringConverter {

  /**
   * Converts a string to another type of string
   *
   * @param  string $string
   * @return string output 
   */
  public function convertString(string $string): string;

  /**
   * Converts a file to of string
   * 
   * @param  string $filename
   * @return string output 
   */
  public function convertFile(string $filename): string;
}
