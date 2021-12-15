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

use Laminas\Config\Reader\Ini as IniReader;
use Laminas\Config\Writer\Ini as IniWriter;
use Exception;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements an INI config data parser
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Ini implements ArrayParser {

  /**
   * @var IniWriter 
   */
  private $writer;

  /**
   * Constructor
   */
  public function __construct() {
    $this->reader = new IniReader();
    $this->writer = new IniWriter();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->writer);
  }

  public function stringToArray(string $string): array {
    try {
      $data = $this->reader->fromString($string);
      return $data;
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  public function fileToArray(string $filename): array {
    try {
      $output = $this->reader->fromFile($filename);
      return $output;
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  public function toString($array): string {
    try {
      return $this->writer->toString($array);
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
