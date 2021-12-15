<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Exceptions\RuntimeException;

/**
 * Defines a resource container 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface ContentParser extends Content {

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendRawFile(string $path);

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path);

  /**
   * Appends a parsed Markdown string to the container
   * 
   * @param  string $markdown the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMarkdown(string $markdown);

  /**
   * Appends a parsed Markdown file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMarkdownFile(string $path);
}
