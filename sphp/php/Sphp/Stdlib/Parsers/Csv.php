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
   */
  public function stringToArray(string $string, string $delimiter = ',', string $enclosure = '"', string $escape = "\\"): array {
    $rows = explode(PHP_EOL, $string);
    $output = [];
    foreach ($rows as $row) {
      $output[] = str_getcsv($row, $delimiter, $enclosure, $escape);
    }
    return $output;
  }

  /**
   * 
   * @param  string $filename
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return array
   * @throws InvalidArgumentException if CSV parsing fails
   */
  public function fileToArray(string $filename, string $delimiter = ',', string $enclosure = '"', string $escape = '\\'): array {
    if (!Filesystem::isAsciiFile($filename)) {
      throw new InvalidArgumentException(sprintf("File '%s' doesn't exist or is not an Ascii file", $filename));
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
