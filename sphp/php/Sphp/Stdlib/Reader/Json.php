<?php

/**
 * Json.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use Zend\Config\Reader\Json as JsonFormat;

/**
 * JSON reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
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

  public function fromString($string) {
    try {
      return $this->parser->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
