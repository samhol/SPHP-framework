<?php

/**
 * Ini.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Zend\Config\Reader\Ini as ZendIni;
use Exception;
use RuntimeException;

/**
 * INI config reader.
 */
class Ini extends AbstractReader {

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
