<?php

/**
 * ContentParsingTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Stdlib\Filesystem;
use ParsedownExtraPlugin;

/**
 * Trait implements functionality of the {@link ContentParserInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentParsingTrait {
  /**
   * 
   * @param  mixed $content
   * @return self for a fluent interface
   */
   abstract public function append($content);

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendRawFile($path) {
    $this->append(Filesystem::toString($path));
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path path to the PHP file
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendPhpFile($path) {
    $this->append(Filesystem::executePhpToString($path));
    return $this;
  }

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md
   * @return self for a fluent interface
   */
  public function appendMd($md) {
    $p = new ParsedownExtraPlugin();
    $this->append($p->text($md));
    return $this;
  }

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendMdFile($path) {
    $this->appendMd(Filesystem::executePhpToString($path));
    return $this;
  }

}
