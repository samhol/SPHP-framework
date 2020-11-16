<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Laminas\Config\Reader\Json as JsonFormat;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements an JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Json implements ArrayParser {

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
  
  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->parser);
  }

  public function stringToArray(string $string): array {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $data = json_decode($string, true, 512, JSON_BIGINT_AS_STRING);
    $thrower->stop();
    return $data;
  }

  public function toString($data, int $flags = JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT): string {
    $serialized = json_encode($data, $flags);
    if (false === $serialized) {
      throw new InvalidArgumentException(json_last_error_msg());
    }
    return $serialized;
  }

}
