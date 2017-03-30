<?php

/**
 * SyntaxHighlightingPane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxhighlighterContainerTrait;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\Foundation\Sites\Buttons\IconButton;

/**
 * Implements an abstract base Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax highlighter
 * @filesource
 */
class SyntaxHighlightingPane extends AbstractPane implements SyntaxHighlighterInterface {

  use SyntaxhighlighterContainerTrait;

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
  public function __construct($title = 'Highlighted code', SyntaxHighlighterInterface $hl = null) {
    if ($hl === null) {
      $hl = new SyntaxHighlighter();
    }
    $this->hl = $hl;
    $this->hl->setDefaultContentCopyController((new IconButton('page-copy', 'Copy'))
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
   * @return SyntaxHighlighter the inner Syntax highlighting component
   */
  public function getSyntaxHighlighter() {
    return $this->hl;
  }

}
