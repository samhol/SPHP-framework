<?php

/**
 * Markdown.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Parsers;

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
   * Parses both block-level and inline elements
   * 
   * @param  string $string
   * @return string parsed HTML string
   * @throws RuntimeException if parsing fails
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
   * Parses inline elements only 
   * 
   * @param  string $string input string
   * @return string parsed HTML string
   * @throws RuntimeException if parsing fails
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
