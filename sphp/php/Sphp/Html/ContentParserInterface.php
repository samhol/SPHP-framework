<?php

/**
 * ContentParserInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines a resource container 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ContentParserInterface extends ContentInterface {

  /**
   * Appends content to the container
   *
   * @param  mixed $content appended content
   * @return self for a fluent interface
   */
  public function append($content);

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendRawFile($path);

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendPhpFile($path);

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md path to the file
   * @return self for a fluent interface
   */
  public function appendMd($md);

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path path to the file
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendMdFile($path);
}
