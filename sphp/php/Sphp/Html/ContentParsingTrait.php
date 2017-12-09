<?php

/**
 * ContentParsingTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Parser;

/**
 * Trait implements functionality of the {@link ContentParser}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentParsingTrait {

  /**
   * 
   * @param  mixed $content
   * @return $this for a fluent interface
   */
  abstract public function append($content);

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public function appendRawFile(string $path) {
    $this->append(Filesystem::toString($path));
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path path to the PHP file
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path) {
    $this->append(Filesystem::executePhpToString($path));
    return $this;
  }

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public function appendMd(string $md) {
    $p = Parser::md();
    $this->append($p->fromString($md));
    return $this;
  }

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public function appendMdFile(string $path) {
    $this->appendMd(Filesystem::executePhpToString($path));
    return $this;
  }

}
