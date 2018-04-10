<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

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

  public function fromString(string $string) {
    try {
      return $this->parser->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
