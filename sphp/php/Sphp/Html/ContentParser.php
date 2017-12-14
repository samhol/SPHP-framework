<?php

/**
 * ContentParser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines a resource container 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ContentParser extends Content {

  /**
   * Appends content to the container
   *
   * @param  mixed,... $content appended content
   * @return $this for a fluent interface
   */
  public function append(...$content);

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendRawFile(string $path);

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path);

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md path to the file
   * @return $this for a fluent interface
   */
  public function appendMd(string $md);

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path path to the file
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the parsing fails for any reason
   */
  public function appendMdFile(string $path);
}
