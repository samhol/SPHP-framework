<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Filesystem;
use JsonException;
use Sphp\Stdlib\Parsers\Exceptions\ParseException;

/**
 * Implements an JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Json implements ArrayParser {

  /**
   * Decodes a file to PHP array
   *
   * @param  string $filename file name
   * @return array output decoded array
   * @throws InvalidArgumentException if file cannot be parsed
   */
  public function fileToArray(string $filename): array {
    //Filesystem::isAsciiFile($filename);
    if (!Filesystem::isFile($filename)) {
      throw new InvalidArgumentException(sprintf("File '%s' doesn't exist or is not an Ascii file", $filename));
    }
    return $this->stringToArray(Filesystem::toString($filename));
  }

  public function stringToArray(string $string): array {
    try {
      $data = json_decode($string, true, 512, JSON_BIGINT_AS_STRING | JSON_THROW_ON_ERROR);
    } catch (JsonException $ex) {
      throw new ParseException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

  public function toString($data, int $flags = JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT): string {
    $serialized = json_encode($data, $flags);
    if (false === $serialized) {
      throw new ParseException(json_last_error_msg());
    }
    return $serialized;
  }

}
