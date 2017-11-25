<?php

/**
 * Markdown.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use Sphp\Exceptions\RuntimeException;
use ParsedownExtraPlugin;

/**
 * Implements a Markdown reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Markdown extends AbstractReader {

  public function fromString(string $string) {
    return $this->parseBlock($string);
  }

  /**
   * 
   * @param  string $string
   * @return string
   * @throws RuntimeException
   */
  public function parseBlock(string $string): string {
    try {
      $data = ParsedownExtraPlugin::instance()->text($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

  /**
   * 
   * @param  string $string
   * @return string
   * @throws RuntimeException
   */
  public function parseInline(string $string): string {
    try {
      $data = ParsedownExtraPlugin::instance()->line($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

}
