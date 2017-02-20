<?php

/**
 * Csv.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Zend\Config\Reader\Ini as ZendIni;
use Exception;
use Sphp\Exceptions\RuntimeException;

/**
 * CSV data reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Csv extends AbstractReader {

  /**
   *
   * @var ZendIni 
   */
  private $parser;

  public function __construct() {
    $this->parser = new ZendIni();
  }

  public function fromString($string) {
    try {
      return $this->parser->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
