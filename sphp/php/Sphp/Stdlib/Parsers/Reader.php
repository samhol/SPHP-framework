<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\RuntimeException;

/**
 * Defines a datatype encoder to PHP array decoder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Reader {

  /**
   * Decodes a file to PHP array
   *
   * @param  string $filename file name
   * @return array output decoded array
   * @throws RuntimeException if file is not readable
   */
  public function readFromFile(string $filename): array;

  /**
   * Decodes a string to PHP array
   *
   * @param  string $string date to decode to array
   * @return array output decoded array
   */
  public function readFromString(string $string): array;
}
