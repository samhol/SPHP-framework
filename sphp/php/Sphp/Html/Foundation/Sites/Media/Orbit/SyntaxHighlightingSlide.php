<?php

/**
 * SyntaxHighlightingSingleAccordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Headings\H2;

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
class SyntaxHighlightingSlide extends AbstractComponent implements SlideInterface, SyntaxHighlighterInterface {

  use \Sphp\Html\Apps\SyntaxhighlighterContainerTrait,
      ActivationTrait;

  /**
   *
   * @var H2
   */
  private $title;
  private $hl;

  /**
   * Constructs a new instance
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct(SyntaxHighlighterInterface $hl = null) {
    parent::__construct("li");
    $this->cssClasses()->lock('orbit-slide');
    if ($hl === null) {
      $hl = new SyntaxHighlighter();
    }
    $this->hl = $hl;
  }
  
  public function setTitle() {
    $this->title->
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighterInterface the inner Syntax Highlighter component
   */
  public function getSyntaxHighlighter() {
    return $this->hl;
  }

  public function contentToString() {
    return $this->hl->getHtml();
  }

}
