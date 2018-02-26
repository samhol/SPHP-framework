<?php

/**
 * SyntaxHighlightingPane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighterInterface;
use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter;

/**
 * Implements an abstract base Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax highlighter
 * @filesource
 */
class SyntaxHighlightingPane extends AbstractPane implements SyntaxHighlighterInterface {

  use \Sphp\Html\Apps\Syntaxhighlighting\SyntaxhighlighterContainerTrait;

  /**
   * @var SyntaxHighlighter
   */
  private $hl;

  /**
   * Constructs a new instance
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct($title = 'Highlighted code', SyntaxHighlighterInterface $hl = null) {
    if ($hl === null) {
      $hl = new SyntaxHighlighter();
    }
    $this->hl = $hl;
    $this->hl->setDefaultContentCopyController(\Sphp\Html\Foundation\Sites\Buttons\Button::pushButton('Copy')
                    ->setSize('tiny'));
    // ->setTitle('Copy code to clipboard'));
    parent::__construct($title, $this->hl);
    $this->addCssClass('syntax-pane');
  }

  public function __destruct() {
    unset($this->hl);
    parent::__destruct();
  }

  /**
   * Returns the inner Syntax highlighting component
   * 
   * @return SyntaxHighlighterInterface the inner Syntax highlighting component
   */
  public function getSyntaxHighlighter(): SyntaxHighlighterInterface {
    return $this->hl;
  }

}
