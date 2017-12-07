<?php

/**
 * Json.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Readers;

use Exception;
use Zend\Config\Reader\Json as JsonFormat;

/**
 * Implements JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Json extends AbstractReader {

  /**
   *
   * @var JsonFormat 
   */
  private $parser;

  public function __construct() {
    $this->parser = new JsonFormat();
  }

  public function fromString(string $string) {
    try {
      return $this->parser->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}