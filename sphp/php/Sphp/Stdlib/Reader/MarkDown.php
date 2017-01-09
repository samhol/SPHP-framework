<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use RuntimeException;
use ParsedownExtraPlugin;

/**
 * MarkDown reader
 */
class MarkDown implements ReaderInterface {

  /**
   * fromFile(): defined by Reader interface.
   *
   * @see    ReaderInterface::fromFile()
   * @param  string $filename
   * @return array
   * @throws RuntimeException
   */
  public function fromFile($filename) {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new RuntimeException(sprintf("File '%s' doesn't exist or not readable", $filename));
    }
    return $this->fromString(file_get_contents($filename));
  }

  /**
   * fromString(): defined by Reader interface.
   *
   * @param  string $string
   * @return array|bool
   * @throws RuntimeException
   */
  public function fromString($string) {
    try {
      $data = ParsedownExtraPlugin::instance()->text($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

}
