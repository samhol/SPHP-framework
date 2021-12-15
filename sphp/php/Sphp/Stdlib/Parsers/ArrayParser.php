<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implementation of ArrayParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface ArrayParser {

  /**
   * Decodes a file to PHP array
   *
   * @param  string $filename file name
   * @return array output decoded array
   * @throws InvalidArgumentException if the file cannot be parsed
   */
  public function fileToArray(string $filename): array;

  /**
   * Decodes a string to PHP array
   *
   * @param  string $string date to decode to array
   * @return array output decoded array
   * @throws InvalidArgumentException if the string cannot be parsed
   */
  public function stringToArray(string $string): array;

  /**
   * Encodes an array to specific data format
   * 
   * @param  array $data
   * @return string Description
   */
  public function toString(array $data): string;
}
