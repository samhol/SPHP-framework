<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps;

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Content;
use Sphp\Html\Component;
use Sphp\Exceptions\RuntimeException;
use Sphp\Html\Apps\ContentCopyController;

/**
 * Defines default properties for a syntax highlighter component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface SyntaxHighlighter extends Content {

  /**
   * Attaches a new copy controller
   *
   * @param  Component $controller button or button content
   * @return ContentCopyController the attached controller
   */
  public function attachContentCopyController(Component $controller): ContentCopyController;

  /**
   * Sets whether the default copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return $this for a fluent interface
   */
  public function useDefaultContentCopyController(bool $use = true);

  /**
   * Loads the source code from the string
   *
   * @param  string $source the source code to parse
   * @param  string $lang name of the source code language
   * @param  bool $format sets whether the code should be formatted
   * @return $this for a fluent interface
   */
  public function setSource(string $source, string $lang, bool $format = false);

  /**
   * Reads the source code from an file
   *
   * @param  string $filename name of the file to read
   * @return $this for a fluent interface
   * @throws RuntimeException if the file was not found
   */
  public function loadFromFile(string $filename);

  /**
   * Executes a PHP file and highlights the resulting output
   * 
   * @param  string $path the path that contains the file
   * @param  string $lang the language name of the output
   * @return $this for a fluent interface
   * @throws RuntimeException if the file does not exist
   */
  public function executeFromFile(string $path, string $lang = 'text');
}
