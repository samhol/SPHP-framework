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
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a CSV data reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Csv implements ArrayParser {

  /**
   * 
   * @param  string $string
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return array
   * @throws RuntimeException
   */
  public function stringToArray(string $string, string $delimiter = ',', string $enclosure = '"', string $escape = "\\"): array {
    try {
      return str_getcsv($string, $delimiter, $enclosure, $escape);
    } catch (\Exception $ex) {
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
   * @throws RuntimeException if CSV parsing fails
   * @throws RuntimeException if file is not readable
   */
  public function fileToArray(string $filename, string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array {
    if (!Filesystem::isFile($filename)) {
      throw new RuntimeException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    $csv = new CsvFile($filename, $delimiter, $enclosure, $escape);
    return $csv->toArray();
  }

  public function toString(array $data, string $delimiter = ',', string $enclosure = '"'): string {
    try {
      $handle = fopen('php://temp', 'r+');
      foreach ($data as $line) {
        fputcsv($handle, $line, $delimiter, $enclosure);
      }
      rewind($handle);
      $contents = '';
      while (!feof($handle)) {
        $contents .= fread($handle, 8192);
      }
      fclose($handle);
      return $contents;
    } catch (\Throwable $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    }
  }

}
