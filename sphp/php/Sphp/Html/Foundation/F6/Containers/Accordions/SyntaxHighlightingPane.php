<?php

/**
 * SyntaxHighlightingPane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Accordions;

use Sphp\Core\CloneNotSupportedTrait as CloneNotSupportedTrait;
use Sphp\Html\Apps\SyntaxHighlighterInterface as SyntaxHighlighterInterface;
use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\Apps\SyntaxHighlighter as SyntaxHighlighter;
use Sphp\Html\Foundation\F6\Buttons\IconButton as IconButton;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter) with a {@link AbstractComponent}
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @filesource
 */
class SyntaxHighlightingPane extends AbstractPane implements SyntaxHighlighterInterface {

  use CloneNotSupportedTrait;

  /**
   *
   * @var SyntaxHighlighter
   */
  private $hl;

  /**
   * Constructs a new instance
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct($title = "Highlighted code", SyntaxHighlighterInterface $hl = null) {
    if ($hl === null) {
      $hl = new SyntaxHighlighter();
    }
    $this->hl = $hl;
    $this->hl->setDefaultContentCopyController((new IconButton("page-copy", "Copy"))->setTiny()->setTitle("Copy code to clipboard"));
    parent::__construct($title, $this->hl);
    $this->addCssClass("syntax-pane");
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->hl);
    parent::__destruct();
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighter the inner Syntax Highlighter component
   */
  public function getHighlighter() {
    return $this->hl;
  }

  /**
   * {@inheritdoc}
   */
  public function setSource($source, $lang) {
    $this->hl->setSource($source, $lang);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function loadFromFile($filename) {
    $this->hl->loadFromFile($filename);
    return $this;
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
