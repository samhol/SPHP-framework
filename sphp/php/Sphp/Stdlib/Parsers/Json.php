<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Zend\Config\Reader\Json as JsonFormat;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements an JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Json implements Writer, Reader {

  use ReaderFromFileTrait;

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

  public function readFromString(string $string): array {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $data = json_decode($string, JSON_BIGINT_AS_STRING);
    $thrower->stop();
    return $data;
  }

  public function write($data, int $flags = JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT): string {
    $serialized = json_encode($data, $flags);
    if (false === $serialized) {
      throw new RuntimeException(json_last_error_msg());
    }
    return $serialized;
  }

}
