<?php

/**
 * SyntaxHighlightingSingleAccordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\ComponentInterface;

/**
 * Class implements an Foundation 6 Accordion containing a single syntax highlighting pane
 * 
 * Class wraps the GeSHi (a Generic Syntax Highlighter) with a {@link AbstractComponent}
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
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
  public function __construct($paneTitle = 'Highlighted code', SyntaxHighlighterInterface $hl = null) {
    parent::__construct(new SyntaxHighlightingPane($paneTitle, $hl));
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighter the inner Syntax Highlighter component
   */
  public function getHighlighter() {
    return $this->getPane()->getSyntaxHighlighter();
  }

  public function setSource($source, $lang) {
    $this->getHighlighter()->setSource($source, $lang);
    return $this;
  }

  public function loadFromFile($filename) {
    $this->getHighlighter()->loadFromFile($filename);
    return $this;
  }

  public function attachContentCopyController(ComponentInterface $button = null) {
    $this->hl->attachContentCopyController($button);
    return $this;
  }

  public function setDefaultContentCopyController($content = 'Copy') {
    $this->hl->setDefaultContentCopyController($content);
    return $this;
  }

  public function useDefaultContentCopyController($use = true) {
    $this->hl->useDefaultContentCopyController($use);
    return $this;
  }

  /**
   * Prints the program code from the file
   *
   * @param  string $path the filepath of the program code
   * @param  mixed|mixed[] $title the title of the accordion
   */
  public static function visualize($path, $title = null) {
    $accordion = (new static());
    $accordion->loadFromFile($path);
    if ($title !== null) {
      $accordion->setPaneTitle($title);
    }
    $accordion->printHtml();
  }

}
