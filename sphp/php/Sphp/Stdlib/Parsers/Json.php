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
use Zend\Config\Reader\Json as JsonFormat;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Json implements ArrayEncoder, ArrayDecoder {

  use ArrayFromFileTrait;

  /**
   * @var JsonFormat 
   */
  private $parser;

  /**
   * Constructor
   */
  public function __construct() {
    $this->parser = new JsonFormat();
  }

  public function arrayFromString(string $string): array {
    try {
      return $this->parser->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  public function encodeArray(array $config, int $flags = JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT): string {
    $serialized = json_encode($config, $flags);
    if (false === $serialized) {
      throw new RuntimeException(json_last_error_msg());
    }
    return $serialized;
  }

}
