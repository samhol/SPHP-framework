<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Zend\Config\Reader\Ini as IniReader;
use Zend\Config\Writer\Ini as IniWriter;
use Exception;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements an INI config data parser
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Ini implements ArrayEncoder, ArrayDecoder {

  use ArrayFromFileTrait;

  /**
   * @var IniReader 
   */
  private $reader;

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

  public function arrayFromString(string $string): array {
    try {
      return $this->reader->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  public function encodeData(array $array): string {
    try {
      return $this->writer->toString($array);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
