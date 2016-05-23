<?php

/**
 * SyntaxHighlightingSingleAccordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Accordions;

use Sphp\Html\Apps\SyntaxHighlighterInterface as SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter as SyntaxHighlighter;
use Sphp\Html\ComponentInterface as ComponentInterface;

/**
 * Class implements an Foundation 6 Accordion containing a single syntax highlighting pane
 * 
 * Class wraps the GeSHi (a Generic Syntax Highlighter) with a {@link AbstractComponent}
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
 * @version 1.1.1
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @filesource
 */
class SyntaxHighlightingSingleAccordion extends AbstractSingleAccordion implements SyntaxHighlighterInterface {


  /**
   * Constructs a new instance
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct($paneTitle = "Highlighted code", SyntaxHighlighterInterface $hl = null) {
    parent::__construct(new SyntaxHighlightingPane($paneTitle, $hl));
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighter the inner Syntax Highlighter component
   */
  public function getHighlighter() {
    return $this->getAccordion()->getHighlighter();
  }

  /**
   * {@inheritdoc}
   */
  public function setSource($source, $lang) {
    $this->getHighlighter()->setSource($source, $lang);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function loadFromFile($filename) {
    $this->getHighlighter()->loadFromFile($filename);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    parent::__clone();
  }


  /**
   * {@inheritdoc}
   */
  public function attachContentCopyController(ComponentInterface $button = null) {
    $this->hl->attachContentCopyController($button);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function setDefaultContentCopyController($content = "Copy") {
    $this->hl->setDefaultContentCopyController($content);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function useDefaultContentCopyController($use = true) {
    $this->hl->useDefaultContentCopyController($use);
    return $this;
  }

}
