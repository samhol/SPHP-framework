<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Zend\Config\Reader\JavaProperties as ZendJavaProperties;
use Exception;
use Sphp\Exceptions\RuntimeException;

/**
 * Java-style properties reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class JavaProperties implements Reader {

  /**
   *
   * @var ZendJavaProperties
   */
  protected $reader;

  public function __construct() {
    $this->reader = new ZendJavaProperties();
  }

  public function fromFile(string $filename) {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new RuntimeException(sprintf(
              "File '%s' doesn't exist or not readable", $filename
      ));
    }
    return $this->reader->fromFile($filename);
  }

  public function fromString($string) {
    try {
      return $this->reader->fromString($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
