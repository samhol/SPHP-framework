<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighterInterface;
use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter;

/**
 * Implements an Foundation Accordion containing a single syntax highlighting pane
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax highlight
 * @license https://opensource.org/licenses/MIT The MIT License
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax highlight
 * @filesource
 */
class SyntaxHighlightingSingleAccordion extends AbstractSingleAccordion implements SyntaxHighlighterInterface {

  use \Sphp\Html\Apps\Syntaxhighlighting\SyntaxhighlighterContainerTrait;

  /**
   * Constructor
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct($paneTitle = 'Highlighted code', SyntaxHighlighterInterface $hl = null) {
    parent::__construct(new SyntaxHighlightingPane($paneTitle, $hl));
  }

  /**
   * Returns the inner Syntax highlighting component
   * 
   * @return SyntaxHighlighter the inner Syntax highlighting component
   */
  public function getSyntaxHighlighter(): SyntaxHighlighterInterface {
    return $this->getPane()->getSyntaxHighlighter();
  }

  /**
   * Prints the program code from the file
   *
   * @param  string $path the file path of the program code
   * @param  mixed|mixed[] $title the title of the accordion
   */
  public static function visualize(string $path, $title = null) {
    $accordion = (new static());
    $accordion->loadFromFile($path);
    if ($title !== null) {
      $accordion->setPaneTitle($title);
    }
    $accordion->printHtml();
  }

}
