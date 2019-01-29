<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter;
use Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter;
use Sphp\Html\Foundation\Sites\Buttons\Button;

/**
 * Implements an abstract base Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax highlighter
 * @license https://opensource.org/licenses/MIT The MIT License
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax highlighter
 * @filesource
 */
class SyntaxHighlightingPane extends AbstractPane implements SyntaxHighlighter {

  use \Sphp\Html\Apps\Syntaxhighlighting\SyntaxhighlighterContainerTrait;

  /**
   * @var GeSHiSyntaxHighlighter
   */
  private $hl;

  /**
   * Constructor
   * 
   * @param string $title
   * @param SyntaxHighlighter $hl the inner syntax highlighting component
   */
  public function __construct($title = 'Highlighted code', SyntaxHighlighter $hl = null) {
    if ($hl === null) {
      $hl = new GeSHiSyntaxHighlighter();
    }
    $this->hl = $hl;
    $this->hl->setContentCopyController(Button::pushButton('<i class="far fa-copy fa-lg"></i>')->setSize('tiny'));
    parent::__construct($title, $this->hl);
    $this->cssClasses()->protectValue('syntax-highlighting-pane');
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
  public function getSyntaxHighlighter(): SyntaxHighlighter {
    return $this->hl;
  }

}
