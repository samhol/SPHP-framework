<?php

/**
 * JavaProperties.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Zend\Config\Reader\JavaProperties as ZendJavaProperties;
use Exception;
use Sphp\Exceptions\RuntimeException;

/**
 * Java-style properties reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class JavaProperties implements ReaderInterface {

  /**
   *
   * @var ZendJavaProperties
   */
  protected $reader;

  public function __construct() {
    $this->reader = new ZendJavaProperties();
  }

  public function fromFile($filename) {
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
