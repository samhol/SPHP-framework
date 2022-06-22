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

use Sphp\Stdlib\Filesystem;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;

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
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendRawFile(string $path) {
    try {
      $this->append(Filesystem::toString($path));
    } catch (\Exception $ex) {
      throw new HtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path  the path to the file
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path) {
    try {
      $this->append(Filesystem::executePhpToString($path));
    } catch (\Exception $ex) {
      throw new HtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a parsed Markdown string to the container
   * 
   * @param  string $md the path to the file
   * @return $this for a fluent interface
   */
  public function appendInlineMd(string $md) {
    $content = ParseFactory::md()->parseString($md, true);
    $this->append($content);
    return $this;
  }

  /**
   * Appends a parsed Markdown string to the container
   * 
   * @param  string $markdown the path to the file
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendMarkdown(string $markdown, bool $inlineOnly = false) {
    $content = ParseFactory::md()->parseString($markdown, $inlineOnly);
    $this->append($content);
    return $this;
  }

  /**
   * Appends a parsed Markdown file to the container
   * 
   * @param  string $path the path to the file
   * @param  bool $executePhp
   * @return $this for a fluent interface
   * @throws HtmlException if the parsing fails for any reason
   */
  public function appendMarkdownFile(string $path, bool $executePhp = true) {
    try {
      if ($executePhp) {
        $this->appendMarkdown(Filesystem::executePhpToString($path));
      } else {
        $this->appendMarkdown(ParseFactory::md()->parseFile($path));
      }
    } catch (\Exception $ex) {
      throw new HtmlException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

}
