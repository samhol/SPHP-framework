<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
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
