<?php

/**
 * SyntaxHighlightingSingleAccordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighterInterface;
use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter;
use Sphp\Html\ComponentInterface;

/**
 * Implements an Foundation Accordion containing a single syntax highlighting pane
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax highlight
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax highlight
 * @filesource
 */
class SyntaxHighlightingSingleAccordion extends AbstractSingleAccordion implements SyntaxHighlighterInterface {

  use \Sphp\Html\Apps\Syntaxhighlighting\SyntaxhighlighterContainerTrait;

  /**
   * Constructs a new instance
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
