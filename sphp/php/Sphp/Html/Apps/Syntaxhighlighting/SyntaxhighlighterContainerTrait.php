<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Component;
use Sphp\Html\Apps\ContentCopyController;

/**
 * Implements framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exceed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait SyntaxhighlighterContainerTrait {

  /**
   * Returns the syntax highlighting object
   * 
   * @return SyntaxHighlighter the syntax highlighting object
   */
  abstract public function getSyntaxHighlighter(): SyntaxHighlighter;

  /**
   * Attaches a new copy controller
   *
   * @param  Component $button button or button content
   * @return ContentCopyController the attached controller
   */
  public function attachContentCopyController(Component $button): ContentCopyController {
    return $this->getSyntaxHighlighter()->attachContentCopyController($button);
  }

  /**
   * Reads the source code from an file
   *
   * @param  string $filename name of the file to read
   * @return $this for a fluent interface
   * @throws RuntimeException if the file was not found
   */
  public function loadFromFile(string $filename) {
    $this->getSyntaxHighlighter()->loadFromFile($filename);
    return $this;
  }

  /**
   * Sets the copier button
   *
   * @param  mixed $content the actual controller or the content of the controller
   * @return ContentCopyController the controller set
   */
  public function setContentCopyController($content = 'Copy'): ContentCopyController {
    $this->getSyntaxHighlighter()->setContentCopyController($content);
    return $this;
  }

  /**
   * Sets whether the copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return $this for a fluent interface
   */
  public function useDefaultContentCopyController(bool $use = true) {
    $this->getSyntaxHighlighter()->useDefaultContentCopyController($use);
    return $this;
  }

  /**
   * Loads the source code from the string
   *
   * @param  string $source the source code to parse
   * @param  string $lang name of the source code language
   * @param  bool $format sets whether the code should be formatted
   * @return $this for a fluent interface
   */
  public function setSource(string $source, string $lang, bool $format = false) {
    $this->getSyntaxHighlighter()->setSource($source, $lang, $format);
    return $this;
  }

  /**
   * Executes a PHP file and highlights the resulting output
   * 
   * @param  string $path the path that contains the file
   * @param  string $lang the language name of the output
   * @return $this for a fluent interface
   * @throws RuntimeException if the file does not exist
   */
  public function executeFromFile(string $path, string $lang = 'text') {
    $this->getSyntaxHighlighter()->executeFromFile($path, $lang);
    return $this;
  }

}
