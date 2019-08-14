<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a YAML encoder and decoder
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Yaml implements ArrayParser {

  use ReaderFromFileTrait;

  public function stringToArray(string $string): array {
    try {
      $parsed = SymfonyYaml::parse($string, SymfonyYaml::PARSE_EXCEPTION_ON_INVALID_TYPE);
      return $parsed;
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  public function toString($data): string {
    try {
      return SymfonyYaml::dump($data, 2, 4, SymfonyYaml::DUMP_EXCEPTION_ON_INVALID_TYPE);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Cannot write data to YAML format', 0, $ex);
    }
  }

}
