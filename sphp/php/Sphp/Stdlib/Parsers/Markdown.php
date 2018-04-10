<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Exception;
use Sphp\Exceptions\RuntimeException;
use ParsedownExtraPlugin;

/**
 * Implements a Markdown reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
