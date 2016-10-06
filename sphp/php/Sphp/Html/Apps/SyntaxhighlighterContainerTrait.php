<?php

/**
 * SyntaxhighlighterContainerTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\ComponentInterface;

/**
 * Class implements Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait SyntaxhighlighterContainerTrait {

  /**
   * 
   * Returns the syntaxhighlighter object
   * 
   * @return SyntaxHighlighterInterface the syntaxhighlighter object
   */
  abstract public function getSyntaxHighlighter();

  /**
   * {@inheritdoc}
   */
  public function attachContentCopyController(ComponentInterface $button = null) {
    return $this->getSyntaxHighlighter()->attachContentCopyController($button);
  }

  /**
   * {@inheritdoc}
   */
  public function loadFromFile($path) {
    $this->getSyntaxHighlighter()->loadFromFile($path);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setDefaultContentCopyController($content = "Copy") {
    $this->getSyntaxHighlighter()->loadFromFile($content);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSource($source, $lang) {
    $this->getSyntaxHighlighter()->setSource($source, $lang);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function useDefaultContentCopyController($use = true) {
    $this->getSyntaxHighlighter()->useDefaultContentCopyController($use);
    return $this;
  }
  

  /**
   * {@inheritdoc}
   */
  public function executeFromFile($path, $lang = 'text') {
    $this->getSyntaxHighlighter()->executeFromFile($path, $lang);
    return $this;
  }

}
