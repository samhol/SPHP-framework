<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Exception;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements a CSV data reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Csv implements ArrayDecoder {

  /**
   * 
   * @param  string $string
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return array
   * @throws RuntimeException
   */
  public function arrayFromString(string $string, string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array {
    try {
      return str_getcsv($string, $delimiter, $enclosure, $escape);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * 
   * @param  string $filename
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return array
   * @throws RuntimeException
   */
  public function arrayFromFile(string $filename, string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new RuntimeException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    $string = file_get_contents($filename);
    return $this->arrayFromString($string, $delimiter, $enclosure, $escape);
  }

}
