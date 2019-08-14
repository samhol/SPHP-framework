<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * A trait to parse array data from a specific file type
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait ReaderFromFileTrait {

  /**
   * Decodes a string to PHP array
   *
   * @param  string $string date to decode to array
   * @return array output decoded array
   */
  abstract public function stringToArray(string $string): array;

  /**
   * Decodes a file to PHP array
   *
   * @param  string $filename file name
   * @return array output decoded array
   * @throws InvalidArgumentException if file cannot be parsed
   */
  public function fileToArray(string $filename): array {
    if (!Filesystem::isAsciiFile($filename)) {
      throw new InvalidArgumentException(sprintf("File '%s' doesn't exist or is not an Ascii file", $filename));
    }
    return $this->stringToArray(Filesystem::toString($filename));
  }

}
