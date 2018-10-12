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
use Symfony\Component\Yaml\Yaml as SymfonyYaml;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a YAML encoder and decoder
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Yaml implements Writer, Reader {

  use ReaderFromFileTrait;

  public function readFromString(string $string): array {
    try {
      $data = SymfonyYaml::parse($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

  public function write($data): string {
    if (!is_array($data)) {
      throw new InvalidArgumentException('Cannot write data to YAML format');
    }
    return SymfonyYaml::dump($data);
  }

}
