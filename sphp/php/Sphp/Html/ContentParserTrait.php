<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Exceptions\RuntimeException;

/**
 * Trait implements functionality of the {@link ContentParser}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait ContentParserTrait {

  /**
   * Appends a new value as the last element
   *
   * @param  mixed $content element
   * @return $this for a fluent interface
   */
  abstract public function append($content);

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendRawFile(string $path) {
    try {
      $this->append(Filesystem::toString($path));
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path) {
    try {
      $this->append(Filesystem::executePhpToString($path));
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMd(string $md) {
    try {
      if ($this instanceof InlineContainer) {
        $content = Parser::md()->parseString($md, true);
      } else {
        $content = Parser::md()->parseString($md);
      }
      $this->append($content);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMdFile(string $path) {
    try {
      $this->appendMd(Filesystem::executePhpToString($path));
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

}
