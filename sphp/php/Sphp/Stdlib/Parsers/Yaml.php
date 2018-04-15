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

/**
 * Implements a YAML to array reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Yaml extends AbstractReader implements ArrayEncoder {

  public function fromString(string $string) {
    try {
      $data = SymfonyYaml::parse($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

  public function encodeArray(array $array): string {
    return SymfonyYaml::dump($array);
  }

}
