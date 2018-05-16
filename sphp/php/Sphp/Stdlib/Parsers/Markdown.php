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
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;

/**
 * Implements a Markdown converter
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Markdown implements StringConverter {

  public function convertString(string $string): string {
    return $this->parseBlock($string);
  }

  public function convertFile(string $filename): string {
    if (!Filesystem::isFile($filename)) {
      throw new FileSystemException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    return $this->convertString(file_get_contents($filename));
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
