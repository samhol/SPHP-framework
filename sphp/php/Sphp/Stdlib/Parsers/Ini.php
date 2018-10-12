<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Zend\Config\Writer\Ini as IniWriter;
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
class Ini implements Writer, Reader {

  use ReaderFromFileTrait;

  /**
   * @var IniWriter 
   */
  private $writer;

  /**
   * Constructor
   */
  public function __construct() {
    $this->writer = new IniWriter();
  }

  public function readFromString(string $string): array {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $data = parse_ini_string($string, true);
    if ($data === false) {
      throw new InvalidArgumentException('Fuck the ini');
    }
    $thrower->stop();
    return $data;
  }

  public function readFromFile(string $filename): array {
    return parse_ini_file (\Sphp\Stdlib\Filesystem::getFullPath($filename), true);
  }

  public function write($array): string {
    try {
      return $this->writer->toString($array);
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
