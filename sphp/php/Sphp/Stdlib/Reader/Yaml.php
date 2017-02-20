<?php

/**
 * Yaml.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use Sphp\Exceptions\RuntimeException;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

/**
 * Implements a YAML reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Yaml extends AbstractReader {

  public function fromString($string) {
    try {
      $data = SymfonyYaml::parse($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

}
