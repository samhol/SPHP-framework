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
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements an JSON reader
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
    $thrower = ErrorToExceptionThrower::getInstance(RuntimeException::class);
    $thrower->start();
    $data = json_decode($string, JSON_BIGINT_AS_STRING);
    $thrower->stop();
    return $data;
  }

  public function encodeData(array $config, int $flags = JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT): string {
    $serialized = json_encode($config, $flags);
    if (false === $serialized) {
      throw new RuntimeException(json_last_error_msg());
    }
    return $serialized;
  }

}
