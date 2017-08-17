<?php

/**
 * SyntaxHighlighterInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\ContentInterface;
use Sphp\Html\ComponentInterface;

/**
 * Defines default properties for a syntax highlighter component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SyntaxHighlighterInterface extends ContentInterface {

  /**
   * Sets the copier button
   *
   * @param  ContentCopyController|ComponentInterface|null $button button or button content
   * @return ContentCopyController the attached controller
   */
  public function attachContentCopyController(ComponentInterface $button = null);

  /**
   * Sets whether the copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return self for a fluent interface
   */
  public function useDefaultContentCopyController(bool $use = true);

  /**
   * Sets the copier button
   *
   * @param  mixed $content the actual controller or the content of the controller
   * @return self for a fluent interface
   */
  public function setDefaultContentCopyController($content = 'Copy');

  /**
   * Loads the source code from the string
   *
   * @param  string $source the source code to parse
   * @param  string $lang name of the source code language
   * @return self for a fluent interface
   */
  public function setSource(string $source, string $lang);

  /**
   * Reads the source code from an file
   *
   * @param  string $filename name of the file to read
   * @return self for a fluent interface
   * @throws \Exception if the file was not found
   */
  public function loadFromFile(string $filename);
}
