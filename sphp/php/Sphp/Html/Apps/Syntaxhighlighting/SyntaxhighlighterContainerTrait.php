<?php

/**
 * SyntaxhighlighterContainerTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\ComponentInterface;

/**
 * Implements framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exceed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait SyntaxhighlighterContainerTrait {

  /**
   * Returns the syntax highlighting object
   * 
   * @return SyntaxHighlighterInterface the syntax highlighting object
   */
  abstract public function getSyntaxHighlighter();

  public function attachContentCopyController(ComponentInterface $button = null) {
    return $this->getSyntaxHighlighter()->attachContentCopyController($button);
  }

  public function loadFromFile(string $path) {
    $this->getSyntaxHighlighter()->loadFromFile($path);
    return $this;
  }

  public function setDefaultContentCopyController($content = "Copy") {
    $this->getSyntaxHighlighter()->loadFromFile($content);
    return $this;
  }

  public function setSource(string $source, string $lang) {
    $this->getSyntaxHighlighter()->setSource($source, $lang);
    return $this;
  }

  public function useDefaultContentCopyController(bool $use = true) {
    $this->getSyntaxHighlighter()->useDefaultContentCopyController($use);
    return $this;
  }

  public function executeFromFile(string $path, string $lang = 'text') {
    $this->getSyntaxHighlighter()->executeFromFile($path, $lang);
    return $this;
  }

}
