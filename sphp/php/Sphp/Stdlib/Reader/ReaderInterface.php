<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Sphp\Stdlib\Reader;

interface ReaderInterface {

  /**
   * Read from a file and create an array
   *
   * @param  string $filename
   * @return mixed
   */
  public function fromFile($filename);

  /**
   * Read from a string and create an array
   *
   * @param  string $string
   * @return mixed
   */
  public function fromString($string);
}
